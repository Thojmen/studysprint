<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

include 'includes/auth.php';
include 'includes/db.php';

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit;
}

if(isset($_POST['create']))
{
    $title = $_POST['title'];
    $deadline = $_POST['deadline'];

    $stmt = $pdo->prepare("
    INSERT INTO projects(user_id,title,deadline)
    VALUES(?,?,?)
    ");

    $stmt->execute([
        $_SESSION['user_id'],
        $title,
        $deadline
    ]);

    header("Location: projects.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Nieuw Project</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'includes/sidebar.php'; ?>

<div class="content">

<h1>Nieuw Project</h1>

<form method="POST">

    <input
        type="text"
        name="title"
        placeholder="Project naam"
    required>

    <input
        type="date"
        name="deadline"
    required>

    <button name="create">
        Project Opslaan
    </button>

</form>

</div>

</body>
</html>