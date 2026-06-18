<?php

include 'includes/auth.php';
include 'includes/db.php';

$project_id = $_GET['project'];

if(isset($_POST['create']))
{
    $title = $_POST['title'];
    $description = $_POST['description'];
    $assigned_to = $_POST['assigned_to'];

    $stmt = $pdo->prepare("
        INSERT INTO tasks
        (
            project_id,
            title,
            description,
            assigned_to,
            status
        )
        VALUES (?, ?, ?, ?, ?)
    ");

    $stmt->execute([
        $project_id,
        $title,
        $description,
        $assigned_to,
        'todo'
    ]);

    header("Location: kanban.php?id=$project_id");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Document</title>
</head>
<body>

<?php include 'includes/sidebar.php'; ?>
<div class="content">

    <a
        class="back-button"
        href="kanban.php?id=<?= $project_id ?>">
        ← Terug naar Kanban
    </a>

    <h1>Nieuwe Taak</h1>

    <form method="POST" class="task-form">

        <label>Titel</label>
        <input
            type="text"
            name="title"
            required>

        <label>Omschrijving</label>
        <textarea
            name="description"></textarea>

        <label>Uitvoerder</label>
        <input
            type="text"
            name="assigned_to">

        <button
            type="submit"
            name="create">
            Taak Opslaan
        </button>

    </form>

</div>
</body>
</html>
