<?php

include 'includes/auth.php';
include 'includes/db.php';

$user_id = $_SESSION['user_id'];

$weekOffset = isset($_GET['week'])
    ? (int)$_GET['week']
    : 0;

$startDate = new DateTime();
$startDate->modify(
    ($weekOffset * 7) . ' days'
);

$startDate->modify('monday this week');

$endDate = clone $startDate;
$endDate->modify('+6 days');

$stmt = $pdo->prepare("
SELECT *
FROM projects
WHERE user_id = ?
AND deadline BETWEEN ? AND ?
ORDER BY deadline ASC
");

$stmt->execute([
    $user_id,
    $startDate->format('Y-m-d'),
    $endDate->format('Y-m-d')
]);

$projects = $stmt->fetchAll();

$days = [];

for($i = 0; $i < 7; $i++)
{
    $day = clone $startDate;
    $day->modify("+$i days");

    $days[] = $day;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Agenda</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<?php include 'includes/sidebar.php'; ?>

<div class="content">

<h1>Agenda</h1>

<div style="margin-bottom:20px;">

<a href="?week=<?php echo $weekOffset - 1; ?>">
    ← Vorige Week
</a>

|

<a href="?week=<?php echo $weekOffset + 1; ?>">
    Volgende Week →
</a>

</div>

<div class="week-calendar">

<?php foreach($days as $day): ?>

<div class="day-card">

<h3>
<?php echo $day->format('D d-m'); ?>
</h3>

<?php

foreach($projects as $project)
{
    if(
        $project['deadline']
        ==
        $day->format('Y-m-d')
    )
    {
        echo "<div class='deadline-item'>";
        echo $project['title'];
        echo "</div>";
    }
}

?>

</div>

<?php endforeach; ?>

</div>

</div>

</body>

</html>