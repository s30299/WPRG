<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'add' && isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];
        $sql = "SELECT * FROM products WHERE id = $product_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();

            if (isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id]['quantity']++;
            } else {
                $_SESSION['cart'][$product_id] = [
                    'id' => $product['id'],
                    'title' => $product['title'],
                    'price' => $product['price'],
                    'quantity' => 1
                ];
            }
        }
    }

    if (isset($_POST['action']) && $_POST['action'] == 'update' && isset($_POST['product_id']) && isset($_POST['quantity'])) {
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        if ($quantity <= 0) {
            unset($_SESSION['cart'][$product_id]);
        } else {
            $_SESSION['cart'][$product_id]['quantity'] = $quantity;
        }
    }

    if (isset($_POST['action']) && $_POST['action'] == 'checkout' && isset($_SESSION['user'])) {

        $user_id = $_SESSION['user']['id'];
        foreach ($_SESSION['cart'] as $item) {
            $product_id = $item['id'];
            $quantity = $item['quantity'];
            $sql = "INSERT INTO orders (user_id, product_id, quantity, status) VALUES ($user_id, $product_id, $quantity, 'pending')";
            $conn->query($sql);
        }
        $_SESSION['cart'] = [];
        echo "Zamówienie zostało złożone.";
    } else if (!isset($_SESSION['user'])) {
        header('Location: login.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Koszyk</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <h1>Twój koszyk</h1>
    <nav>
        <a href="index.php">Strona główna</a>
        <a href="cart.php">Koszyk</a>
        <?php if (isset($_SESSION['user'])): ?>
            <a href="logout.php">Wyloguj</a>
            <?php if ($_SESSION['user']['role'] == 'admin' || $_SESSION['user']['role'] == 'seller'): ?>
                <a href="admin.php">Panel administracyjny</a>
            <?php endif; ?>
        <?php else: ?>
            <a href="login.php">Zaloguj</a>
            <a href="register.php">Zarejestruj</a>
        <?php endif; ?>
    </nav>
</header>
<main>
    <h2>Zawartość koszyka</h2>
    <div class="cart">
        <?php
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                echo "<div class='cart-item'>
                        <h3>{$item['title']}</h3>
                        <p>Cena: {$item['price']} zł</p>
                        <p>Ilość: {$item['quantity']}</p>
                        <form method='post' action='cart.php'>
                            <input type='hidden' name='product_id' value='{$item['id']}'>
                            <input type='hidden' name='action' value='update'>
                            <input type='number' name='quantity' value='{$item['quantity']}'>
                            <button type='submit'>Aktualizuj ilość</button>
                        </form>
                    </div>";
            }
            echo "<form method='post' action='cart.php'>
                    <input type='hidden' name='action' value='checkout'>
                    <button type='submit'>Złóż zamówienie</button>
                </form>";
        } else {
            echo "Twój koszyk jest pusty.";
        }
        ?>
    </div>
</main>
</body>
</html>
