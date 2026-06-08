<?php

    include 'includes/auth.php';
    include 'includes/db.php';

    $id = $_GET['id'];

    $stmt = $pdo->prepare("
    SELECT *
    FROM tasks
    WHERE id = ?
    ");

    $stmt->execute([$id]);

    $task = $stmt->fetch();

    if(!$task)
    {
        die("Taak niet gevonden");
    }

    if(isset($_POST['update']))
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $assigned_to = $_POST['assigned_to'];

        $update = $pdo->prepare("
        UPDATE tasks
        SET title = ?,
            description = ?,
            assigned_to = ?
        WHERE id = ?
        ");

        $update->execute([
            $title,
            $description,
            $assigned_to,
            $id
        ]);

        header(
            "Location: kanban.php?id=" .
            $task['project_id']
        );

        exit;
    }
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Taak Bewerken</title>
        <link rel="stylesheet" href="assets/css/style.css">
    </head>

    <body>

        <?php include 'includes/sidebar.php'; ?>

        <div class="content">
            <h1>Taak Bewerken</h1>
            <form method="POST">
                <input
                    type="text"
                    name="title"
                    value="<?= htmlspecialchars($task['title']) ?>"
                required>

                <textarea name="description"><?= htmlspecialchars($task['description']) ?></textarea>
                <input type="text" name="assigned_to" value="<?= htmlspecialchars($task['assigned_to']) ?>">
                <button
                    type="submit"
                    name="update">
                    Opslaan
                </button>
            </form>
        </div>
    </body>
</html>