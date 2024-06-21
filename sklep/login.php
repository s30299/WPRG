<?php
global $conn;
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header('Location: index.php');
            exit();
        } else {
            $error = "Nieprawidłowe hasło.";
        }
    } else {
        $error = "Nie znaleziono użytkownika o podanej nazwie.";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zaloguj się</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <h1>Zaloguj się</h1>
</header>
<main>
    <form method="post">
        <label for="username">Nazwa użytkownika:</label>
        <input type="text" name="username" id="username" required>
        <label for="password">Hasło:</label>
        <input type="password" name="password" id="password" required>
        <button type="submit">Zaloguj</button>
        <?php if (isset($error)): ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>
    </form>
</main>
</body>
</html>
