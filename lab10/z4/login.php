<?php
session_start();
function logging($email, $password,&$name,&$surname): bool
{
    $file = fopen("dane.txt", "r");
    if ($file) {
        while (($line = fgets($file)) !== false) {
            list($NAME,$SURNAME,$EMAIL,$PASSWORD) = explode(';', $line);
            if (trim($EMAIL) == $email && trim($PASSWORD) == $password) {
                $name=$NAME;
                $surname=$SURNAME;
                fclose($file);
                return true;
            }
        }
        fclose($file);
    }
    return false;
}
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $file = fopen("dane.txt", "r");
    $name='';
    $surname='';
    if (logging($email, $password, $name, $surname)) {
        $_SESSION['loggedIN'] = true;
        $_SESSION['email'] = $email;
        $_SESSION['name']=$name;
        $_SESSION['surname']=$surname;
    } else {
        $loginError = "Zły email lub hasło.";
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Logowanie</title>
    </head>
    <body>
    <?php if (isset($_SESSION['loggedIN']) && $_SESSION['loggedIN']): ?>
        <h1>Witaj,
            <?php echo $_SESSION['name']." ".$_SESSION['surname']; ?>!</h1>
        <p>Zostałeś poprawnie zalogowany.</p>
        <form method="post" action="">
            <button type="submit" name="logout">Wyloguj</button>
        </form>
    <?php else: ?>
    <h1>Logowanie</h1>
    <?php if (isset($loginError)): ?>
        <p><?php echo $loginError; ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="password">Hasło:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Zaloguj</button>
    </form>
    <?php endif; ?>
    </body>
</html>