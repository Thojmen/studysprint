<?php
session_start();
include 'includes/db.php';

$user_id = $_SESSION['user_id'];

$projects = $pdo->prepare("SELECT * FROM projects WHERE user_id = ? ORDER BY deadline ASC LIMIT 3");
$projects->execute([$user_id]);
$deadlines = $projects->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'includes/sidebar.php'; ?>

<div class="content">
    <h1>Welkom <?php echo $_SESSION['username']; ?></h1>

    <div class="card-container">

        <div class="card">
            <h2>Komende deadlines</h2>

            <?php foreach($deadlines as $project): ?>
                <p>
                    <?php echo $project['title']; ?>
                    -
                    <?php echo $project['deadline']; ?>
                </p>
            <?php endforeach; ?>
        </div>

        <div class="card">
            <a href="create-project.php">
                <button>Nieuwe taak</button>
            </a>
        </div>

    </div>
</div>

</body>
</html>