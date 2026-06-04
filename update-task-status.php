<?php

include 'includes/auth.php';
include 'includes/db.php';

if(
    isset($_POST['task_id'])
    &&
    isset($_POST['status'])
)
{
    $stmt = $pdo->prepare("
    UPDATE tasks
    SET status = ?
    WHERE id = ?
    ");

    $stmt->execute([
        $_POST['status'],
        $_POST['task_id']
    ]);
}