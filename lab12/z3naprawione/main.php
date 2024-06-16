<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rejestracja</title>
</head>
<body>

<?php
$dbuser = 'root';
$dbpass = '';
$dbname = 'testdb';
$dsn = "mysql:host=localhost;dbname=$dbname;charset=utf8mb4";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$pdo = null;
try {
    $pdo = new PDO($dsn, $dbuser, $dbpass, $options);

    $sql = "CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL,
                fullname VARCHAR(255) NOT NULL,
                birthdate DATE NOT NULL
            )";
    $pdo->exec($sql);
    echo "Table created successfully.<br>";

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
$success_message = '';
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];
    $birthdate = $_POST['birthdate'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, fullname, birthdate) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$username, $email, $hashed_password, $fullname, $birthdate]);
        $success_message = "User registered successfully.";
    } catch (PDOException $e) {
        $error_message = "Error: " . $e->getMessage();
    }
}
$count = 0;
try {
    $stmt = $pdo->query("SELECT COUNT(*) AS count FROM users");
    $count = $stmt->fetchColumn();
} catch (PDOException $e) {
    $error_message = "Error: " . $e->getMessage();
}
?>

<h2>Rejestracja</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label>Username:</label><br>
    <input type="text" id="username" name="username" required><br><br>

    <label>Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" id="password" name="password" required><br><br>

    <label>Full Name:</label><br>
    <input type="text" id="fullname" name="fullname" required><br><br>

    <label>Birthdate:</label><br>
    <input type="date" id="birthdate" name="birthdate" required><br><br>

    <input type="submit" value="Register">
</form>

<?php
if (!empty($success_message)) {
    echo "<p style='color: green;'>$success_message</p>";
}

if (!empty($error_message)) {
    echo "<p style='color: red;'>$error_message</p>";
}
echo "<p>Total registered users: $count</p>";

?>

</body>
</html>
