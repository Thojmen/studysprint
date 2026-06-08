<?php
    include 'includes/auth.php';
    include 'includes/db.php';

    $id = $_GET['id'];

    $stmt = $pdo->prepare("
        SELECT *
        FROM projects
        WHERE id = ?
    ");

    $stmt->execute([$id]);

    $project = $stmt->fetch();

    if(!$project)
    {
        die("Project niet gevonden");
    }

    if(isset($_POST['update']))
    {
        $title = $_POST['title'];
        $deadline = $_POST['deadline'];

        $update = $pdo->prepare("
        UPDATE projects
        SET title = ?,
            deadline = ?
        WHERE id = ?
        ");

        $update->execute([
            $title,
            $deadline,
            $id
        ]);

        header("Location: projects.php");
        exit;
    }
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Project Bewerken</title>
        <link rel="stylesheet" href="assets/css/style.css">
    </head>

    <body>

    <?php include 'includes/sidebar.php'; ?>

    <div class="content">
        <h1>Project Bewerken</h1>
        <form method="POST">
            <input
                type="text"
                name="title"
                value="<?= htmlspecialchars($project['title']) ?>"
            required>

            <input
                type="date"
                name="deadline"
                value="<?= $project['deadline'] ?>"
            required>

            <button
                type="submit"
                name="update">
                Opslaan
            </button>
        </form>
    </div>

    </body>
</html>