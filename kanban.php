<?php

include 'includes/auth.php';
include 'includes/db.php';

$project_id = $_GET['id'];

$stmt = $pdo->prepare("
SELECT *
FROM tasks
WHERE project_id = ?
");

$stmt->execute([$project_id]);

$tasks = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Kanban Bord</title>

    <link rel="stylesheet" href="assets/css/style.css">

    <script src="assets/js/kanban.js" defer></script>

</head>

<body>

<?php include 'includes/sidebar.php'; ?>

<div class="content">

<h1>Kanban Bord</h1>

<a href="create-task.php?project=<?php echo $project_id; ?>">
    <button>Nieuwe Taak</button>
</a>

<div class="kanban-board">

    <!-- TO DO -->

    <div
        class="column"
        data-status="todo"
        ondrop="drop(event)"
        ondragover="allowDrop(event)"
    >

        <h2>To Do</h2>

        <?php foreach($tasks as $task): ?>

            <?php if($task['status'] == 'todo'): ?>

                <div
                    class="task"
                    draggable="true"
                    ondragstart="drag(event)"
                    id="task-<?php echo $task['id']; ?>"
                >

                    <h3><?php echo $task['title']; ?></h3>

                    <p><?php echo $task['description']; ?></p>

                    <small>
                        <?php echo $task['assigned_to']; ?>
                    </small>

                    <br><br>

                    <a href="delete-task.php?id=<?php echo $task['id']; ?>">
                        Verwijderen
                    </a>

                    <a href="edit-task.php?id=<?php echo $task['id']; ?>">
                        Bewerken
                    </a>

                    <br><br>
                </div>

            <?php endif; ?>

        <?php endforeach; ?>

    </div>

    <!-- DOING -->

    <div
        class="column"
        data-status="doing"
        ondrop="drop(event)"
        ondragover="allowDrop(event)"
    >

        <h2>Doing</h2>

        <?php foreach($tasks as $task): ?>

            <?php if($task['status'] == 'doing'): ?>

                <div
                    class="task"
                    draggable="true"
                    ondragstart="drag(event)"
                    id="task-<?php echo $task['id']; ?>"
                >

                    <h3><?php echo $task['title']; ?></h3>

                    <p><?php echo $task['description']; ?></p>

                    <small>
                        <?php echo $task['assigned_to']; ?>
                    </small>

                    <br><br>

                    <a href="delete-task.php?id=<?php echo $task['id']; ?>">
                        Verwijderen
                    </a>

                </div>

            <?php endif; ?>

        <?php endforeach; ?>

    </div>

    <!-- DONE -->

    <div
        class="column"
        data-status="done"
        ondrop="drop(event)"
        ondragover="allowDrop(event)"
    >

        <h2>Done</h2>

        <?php foreach($tasks as $task): ?>

            <?php if($task['status'] == 'done'): ?>

                <div
                    class="task"
                    draggable="true"
                    ondragstart="drag(event)"
                    id="task-<?php echo $task['id']; ?>"
                >

                    <h3><?php echo $task['title']; ?></h3>

                    <p><?php echo $task['description']; ?></p>

                    <small>
                        <?php echo $task['assigned_to']; ?>
                    </small>

                    <br><br>

                    <a href="delete-task.php?id=<?php echo $task['id']; ?>">
                        Verwijderen
                    </a>

                </div>

            <?php endif; ?>

        <?php endforeach; ?>

    </div>

</div>

</div>

</body>
</html>