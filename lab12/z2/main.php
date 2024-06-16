<?php
$dbuser = 'root';
$dbpass = '';
$dbname = 'testdb';


$dsn = "mysql:host=localhost;charset=utf8mb4";
try {
    $pdo = new PDO($dsn, $dbuser, $dbpass);
    $sql = "CREATE DATABASE IF NOT EXISTS testdb";
    $pdo->exec($sql);
    echo "Database 'testdb' created successfully.<br>";

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
$dsn = "mysql:host=localhost;dbname=$dbname;charset=utf8mb4";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $pdo = new PDO($dsn, $dbuser, $dbpass, $options);

    echo "Connected to the database successfully.<br>";
    $sql = "CREATE TABLE IF NOT EXISTS Person (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                age INT NOT NULL
            )";
    $pdo->exec($sql);
    echo "Table Person created successfully.<br>";
    $sql = "CREATE TABLE IF NOT EXISTS Cars (
                id INT AUTO_INCREMENT PRIMARY KEY,
                model VARCHAR(255) NOT NULL,
                year INT NOT NULL,
                person_id INT,
                FOREIGN KEY (person_id) REFERENCES Person(id)
            )";
    $pdo->exec($sql);
    echo "Table Cars created successfully.<br>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_person'])) {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $sql = "INSERT INTO Person (name, age) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $age]);
        echo "Person added successfully.<br>";
    } elseif (isset($_POST['add_car'])) {
        $model = $_POST['model'];
        $year = $_POST['year'];
        $person_id = $_POST['person_id'];
        $sql = "INSERT INTO Cars (model, year, person_id) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$model, $year, $person_id]);
        echo "Car added successfully.<br>";
    } elseif (isset($_POST['update_person'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $age = $_POST['age'];
        $sql = "UPDATE Person SET name = ?, age = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $age, $id]);
        echo "Person updated successfully.<br>";
    } elseif (isset($_POST['update_car'])) {
        $id = $_POST['id'];
        $model = $_POST['model'];
        $year = $_POST['year'];
        $person_id = $_POST['person_id'];
        $sql = "UPDATE Cars SET model = ?, year = ?, person_id = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$model, $year, $person_id, $id]);
        echo "Car updated successfully.<br>";
    }
}
if (isset($_GET['delete_person'])) {
    try{
        $id = $_GET['delete_person'];
        $sql = "DELETE FROM Person WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        echo "Person deleted successfully.<br>";
    }catch (Exception $e){
        echo "Error: " . $e->getMessage();
    }
} elseif (isset($_GET['delete_car'])) {
    $id = $_GET['delete_car'];
    $sql = "DELETE FROM Cars WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    echo "Car deleted successfully.<br>";
}
$persons = $pdo->query("SELECT * FROM Person")->fetchAll();
$cars = $pdo->query("SELECT * FROM Cars")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Table</title>
</head>
<body>
<h2>Add a New Person</h2>
<form method="post">
    <label>Name:</label>
    <input type="text" id="name" name="name" required>
    <br>
    <label">Age:</label>
    <input type="number" id="age" name="age" required>
    <br>
    <input type="submit" name="add_person" value="Add Person">
</form>

<h2>Add a New Car</h2>
<form method="post">
    <label>Model:</label>
    <input type="text" id="model" name="model" required>
    <br>
    <label>Year:</label>
    <input type="number" id="year" name="year" required>
    <br>
    <label>Person:</label>
    <select id="person_id" name="person_id" required>
        <?php foreach ($persons as $person): ?>
            <option value="<?= $person['id'] ?>"><?= $person['name'] ?></option>
        <?php endforeach; ?>
    </select>
    <br>
    <input type="submit" name="add_car" value="Add Car">
</form>

<h2>Persons</h2>
<table border="1">
    <thead>
    <tr>
        <th>Name</th>
        <th>Age</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($persons as $person): ?>
        <tr>
            <td><?= $person['name'] ?></td>
            <td><?= $person['age'] ?></td>
            <td>
                <a href="?edit_person=<?= $person['id'] ?>">Edit</a>
                <a href="?delete_person=<?= $person['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<h2>Cars</h2>
<table border="1">
    <thead>
    <tr>
        <th>Model</th>
        <th>Year</th>
        <th>Owner</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($cars as $car): ?>
        <tr>
            <td><?= $car['model'] ?></td>
            <td><?= $car['year'] ?></td>
            <td>
                <?php
                $owner = array_filter($persons, function ($person) use ($car) {
                    return $person['id'] == $car['person_id'];
                });
                $owner = array_shift($owner);
                echo $owner ? $owner['name'] : 'None';
                ?>
            </td>
            <td>
                <a href="?edit_car=<?= $car['id'] ?>">Edit</a>
                <a href="?delete_car=<?= $car['id'] ?>" onclick="return confirm('Potwierdź')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php if (isset($_GET['edit_person'])): ?>
    <?php
    $id = $_GET['edit_person'];
    $person = $pdo->query("SELECT * FROM Person WHERE id = $id")->fetch();
    ?>
    <h2>Edit Person</h2>
    <form method="post">
        <input type="hidden" name="id" value="<?= $person['id'] ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?= $person['name'] ?>" required>
        <br>
        <label for="age">Age:</label>
        <input type="number" id="age" name="age" value="<?= $person['age'] ?>" required>
        <br>
        <input type="submit" name="update_person" value="Update Person">
    </form>
<?php endif; ?>

<?php if (isset($_GET['edit_car'])): ?>
    <?php
    $id = $_GET['edit_car'];
    $car = $pdo->query("SELECT * FROM Cars WHERE id = $id")->fetch();
    ?>
    <h2>Edit Car</h2>
    <form method="post">
        <input type="hidden" name="id" value="<?= $car['id'] ?>">
        <label for="model">Model:</label>
        <input type="text" id="model" name="model" value="<?= $car['model'] ?>" required>
        <br>
        <label for="year">Year:</label>
        <input type="number" id="year" name="year" value="<?= $car['year'] ?>" required>
        <br>
        <label for="person_id">Person:</label>
        <select id="person_id" name="person_id" required>
            <?php foreach ($persons as $person): ?>
                <option value="<?= $person['id'] ?>" <?= $person['id'] == $car['person_id'] ? 'selected' : '' ?>>
                    <?= $person['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>
        <input type="submit" name="update_car" value="Update Car">
    </form>
<?php endif; ?>
</body>
</html>
