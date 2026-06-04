<?php

include 'includes/auth.php';
include 'includes/db.php';

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("
SELECT *
FROM projects
WHERE user_id = ?
ORDER BY deadline
");

$stmt->execute([$user_id]);

$projects = $stmt->fetchAll();
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

<table border="1" width="100%">

<tr>
<th>Project</th>
<th>Deadline</th>
</tr>

<?php foreach($projects as $project): ?>

<tr>
<td><?= $project['title']; ?></td>
<td><?= $project['deadline']; ?></td>
</tr>

<?php endforeach; ?>

</table>

</div>

</body>
</html>