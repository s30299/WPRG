<?php
global $conn;
include 'config.php';
session_start();

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$product_id = $_GET['id'];

$sql = "SELECT * FROM products WHERE id = $product_id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    header('Location: index.php');
    exit();
}

$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title><?php echo $product['title']; ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <h1><?php echo $product['title']; ?></h1>
    <nav>
        <a href="index.php">Strona główna</a>
        <a href="cart.php">Koszyk</a>
        <?php if (isset($_SESSION['user'])): ?>
            <a href="logout.php">Wyloguj</a>
            <?php if ($_SESSION['user']['role'] == 'admin'): ?>
                <a href="admin.php">Panel administracyjny</a>
            <?php endif; ?>
        <?php else: ?>
            <a href="login.php">Zaloguj</a>
            <a href="register.php">Zarejestruj</a>
        <?php endif; ?>
    </nav>
</header>
<main>
    <div class="product-details">
        <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['title']; ?>">
        <p>Cena: <?php echo $product['price']; ?> zł</p>
        <p>Ilość: <?php echo $product['quantity']; ?></p>
        <p><?php echo $product['description']; ?></p>
        <?php if ($product['quantity'] > 0): ?>
            <form action="cart.php" method="post">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                <label for="quantity">Ilość:</label>
                <input type="number" name="quantity" id="quantity" value="1" min="1" max="<?php echo $product['quantity']; ?>">
                <button type="submit">Dodaj do koszyka</button>
            </form>
        <?php else: ?>
            <p>Produkt niedostępny.</p>
        <?php endif; ?>
    </div>
</main>
</body>
</html>
