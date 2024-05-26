<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (checkPassword($password) && isEmailUnique($email)){
        $file = fopen("dane.txt", "a");
        if ($file) {
            $data = "$firstName;$lastName;$email;$password\n";
            fwrite($file, $data);
            fclose($file);
            $message = "Rejestracja zakończona";
        } else {
            $message = "Błąd";
        }
    }   else {
            if(!checkPassword($password)){
                $message = "Hasło musi zawierać co najmniej 6 znaków, jedną wielką literę, cyfrę oraz znak specjalny";
            }
            if(!isEmailUnique($email)){
                $message = "Email musi być unikalny";
            }
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Rejestracja</title>
</head>
<body>
<h1>Rejestracja</h1>
<?php if (isset($message)): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>
<form method="post" action="">
    <label>Imie:</label>
    <input type="text" name="first_name" required><br><br>
    <label>Nazwisko:</label>
    <input type="text" name="last_name" required><br><br>
    <label>Email:</label>
    <input type="email" name="email" required><br><br>
    <label >Haslo:</label>
    <input type="password" name="password" required><br><br>
    <button type="submit">Zarejestruj</button>
</form>
</body>
</html>
<?php
function checkPassword($password) {
    return strlen($password) >= 6 && preg_match('/[A-Z]/', $password) && preg_match('/[0-9]/', $password) && preg_match('/[!@#$%]/', $password);
}
function isEmailUnique($email): bool
{
    $file = fopen("dane.txt", "r");
    if ($file) {
        while (($line = fgets($file)) !== false) {
            list(,,$savedEmail,) = explode(';', $line);
            if (trim($savedEmail) == $email) {
                fclose($file);
                return false;
            }
        }
        fclose($file);
    }
    return true;
}
?>