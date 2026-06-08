<?php
session_start();
include 'includes/db.php';

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM projects WHERE user_id = ?");
$stmt->execute([$user_id]);
$projects = $stmt->fetchAll();

if(isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $delete = $pdo->prepare("DELETE FROM projects WHERE id = ?");
    $delete->execute([$id]);

    header("Location: projects.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Projecten</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'includes/sidebar.php'; ?>

<div class="content">
    <h1>Projecten</h1>
    <?php foreach($projects as $project): ?>

        <div class="project-card">
            <h2><?php echo $project['title']; ?></h2>
            <p>Deadline: <?php echo $project['deadline']; ?></p>

            <a href="kanban.php?id=<?php echo $project['id']; ?>">
                Open project
            </a>

            <a href="projects.php?delete=<?php echo $project['id']; ?>">
                Verwijderen
            </a>

            <a href="edit-project.php?id=<?= $project['id'] ?>">
                Bewerken
            </a>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>