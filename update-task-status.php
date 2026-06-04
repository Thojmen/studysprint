<?php

include 'includes/db.php';

$id = $_POST['task_id'];
$status = $_POST['status'];

$stmt = $pdo->prepare("
UPDATE tasks
SET status = ?
WHERE id = ?
");

$stmt->execute([
    $status,
    $id
]);