<?php

include 'includes/auth.php';
include 'includes/db.php';

$project_id = $_GET['project'];

if(isset($_POST['save']))
{
    $stmt = $pdo->prepare("
    INSERT INTO tasks
    (
        project_id,
        title,
        description,
        assigned_to,
        status
    )
    VALUES(?,?,?,?,?)
    ");

    $stmt->execute([
        $project_id,
        $_POST['title'],
        $_POST['description'],
        $_POST['assigned_to'],
        'todo'
    ]);

    header("Location: kanban.php?id=$project_id");
}
?>

<form method="POST">

<input
type="text"
name="title"
placeholder="Taak naam"
required>

<textarea
name="description"
placeholder="Omschrijving"></textarea>

<input
type="text"
name="assigned_to"
placeholder="Persoon">

<button name="save">
Opslaan
</button>

</form>