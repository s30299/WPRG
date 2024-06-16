<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Create And Delete</title>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testdb";
$dbuser = 'root';
$dbpass = '';
$dsn = "mysql:host=localhost;charset=utf8mb4";
try {
    $pdo = new PDO($dsn, $dbuser, $dbpass);
    $sql = "CREATE DATABASE IF NOT EXISTS testdb";
    $pdo->exec($sql);
    echo "Database 'testdb' created successfully.<br>";

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}



$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function createTable($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(30) NOT NULL,
        lastname VARCHAR(30) NOT NULL,
        email VARCHAR(50),
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    if ($conn->query($sql) === TRUE) {
        echo "Tabela users została utworzona pomyślnie.<br>";
    } else {
        echo "Błąd podczas tworzenia tabeli: " . $conn->error . "<br>";
    }
}

function deleteTable($conn) {
    $sql = "DROP TABLE IF EXISTS users";

    if ($conn->query($sql) === TRUE) {
        echo "Tabela users została usunięta pomyślnie.<br>";
    } else {
        echo "Błąd podczas usuwania tabeli: " . $conn->error . "<br>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    deleteTable($conn);
}

if (!isset($_POST['delete'])) {
    createTable($conn);
}

$conn->close();
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="submit" name="delete" value="Usuń tabelę">
</form>

</body>
</html>
