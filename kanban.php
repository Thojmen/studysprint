<?php
session_start();
include 'includes/db.php';

$project_id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM tasks WHERE project_id = ?");
$stmt->execute([$project_id]);
$tasks = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kanban</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'includes/sidebar.php'; ?>

<div class="kanban-board">

    <div class="column">
        <h2>To Do</h2>

        <?php foreach($tasks as $task): ?>
            <?php if($task['status'] == 'todo'): ?>

                <div class="task">
                    <h3><?php echo $task['title']; ?></h3>
                    <p><?php echo $task['description']; ?></p>
                    <small><?php echo $task['assigned_to']; ?></small>
                </div>

            <?php endif; ?>
        <?php endforeach; ?>
    </div>

</div>

</body>
</html>