<?php
include 'includes/db.php';

if(isset($_POST['register']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("
        INSERT INTO users(username,email,password)
        VALUES(?,?,?)
    ");

    $stmt->execute([
        $username,
        $email,
        $password
    ]);

    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Registreren</title>
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>

        <div class="login-container">

            <form method="POST">

                <h1>Registreren</h1>

                <input type="text" name="username" placeholder="Gebruikersnaam" required>

                <input type="email" name="email" placeholder="Email" required>

                <input type="password" name="password" placeholder="Wachtwoord" required>

                <button name="register">
                Registreren
                </button>

                <a href="login.php">
                Terug naar login
                </a>

            </form>

        </div>

    </body>
</html>