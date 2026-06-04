<?php

include 'includes/db.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("
DELETE FROM tasks
WHERE id = ?
");

$stmt->execute([$id]);

header("Location: " . $_SERVER['HTTP_REFERER']);