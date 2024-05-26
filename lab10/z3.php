<?php
session_start();
$login = "admin";
$truePassword = "admin";
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username == $login && $password == $truePassword) {
        $_SESSION['loggedin'] = true;
    } else {
        $loginError = "Błędny login lub hasło.";
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>z3</title>
</head>
<body>
<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']): ?>
    <h1>Zalogowano jako: <?php echo $login ?>.</h1>
    <p>Zostałeś poprawnie zalogowany.</p>
    <form method="post">
        <button type="submit" name="logout">Wyloguj</button>
    </form>
<?php else: ?>
    <h1>Logowanie</h1>
    <?php if (isset($loginError)): ?>
        <p><?php echo $loginError; ?></p>
    <?php endif ?>
    <form method="post">
        <label>Login:</label><br>
        <input type="text"  name="username" ><br><br>
        <label>Password:</label><br>
        <input type="password" name="password" ><br><br>
        <button type="submit">Zaloguj</button>
    </form>
<?php endif; ?>
</body>
</html>
