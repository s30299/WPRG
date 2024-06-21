<?php
global $conn;
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    if($username=='admin'){
        $sql = "INSERT INTO users (username, password, email,role) VALUES ('$username', '$password', '$email','admin')";
    }else {
        $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
    }
    if ($conn->query($sql) === TRUE) {
        header('Location: login.php');
        exit();
    } else {
        $error = "Błąd rejestracji: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zarejestruj się</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <h1>Zarejestruj się</h1>
</header>
<main>
    <form method="post">
        <label for="username">Nazwa użytkownika:</label>
        <input type="text" name="username" id="username" required>
        <label for="password">Hasło:</label>
        <input type="password" name="password" id="password" required>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <button type="submit">Zarejestruj</button>
        <?php if (isset($error)): ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>
    </form>
</main>
</body>
</html>
