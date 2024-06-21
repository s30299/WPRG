<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

if ($_SESSION['user']['role'] != 'seller' && $_SESSION['user']['role'] != 'admin') {
    echo "Brak dostępu do tej funkcji.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "Plik nie jest obrazem.";
        $uploadOk = 0;
    }

    if ($uploadOk == 1 && move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $image_path = $target_file;
        $sql = "INSERT INTO products (title, image, price, quantity, description)
                VALUES ('$title', '$image_path', $price, $quantity, '$description')";

        if ($conn->query($sql) === TRUE) {
            echo "Przedmiot został dodany pomyślnie.";
        } else {
            echo "Błąd dodawania przedmiotu: " . $conn->error;
        }
    } else {
        echo "Wystąpił błąd podczas przesyłania pliku.";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_product'])) {
    $product_id = $_POST['product_id'];

    $sql_delete_orders = "DELETE FROM orders WHERE product_id = $product_id";
    if ($conn->query($sql_delete_orders) === TRUE) {
        $sql_delete_comments = "DELETE FROM comments WHERE product_id = $product_id";
        if ($conn->query($sql_delete_comments) === TRUE) {
            $sql_delete_product = "DELETE FROM products WHERE id = $product_id";
            if ($conn->query($sql_delete_product) === TRUE) {
                echo "Produkt został usunięty pomyślnie.";
            } else {
                echo "Błąd usuwania produktu: " . $conn->error;
            }
        } else {
            echo "Błąd usuwania komentarzy: " . $conn->error;
        }
    } else {
        echo "Błąd usuwania powiązanych zamówień: " . $conn->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['complete_order'])) {
    $order_id = $_POST['order_id'];

    $sql_update = "UPDATE orders SET status = 'completed' WHERE id = $order_id";
    if ($conn->query($sql_update) === TRUE) {
        echo "Zamówienie zostało zrealizowane.";
    } else {
        echo "Błąd podczas realizacji zamówienia: " . $conn->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_role'])) {
    $user_id = $_POST['user_id'];
    $new_role = $_POST['new_role'];

    $sql_update_role = "UPDATE users SET role = '$new_role' WHERE id = $user_id";
    if ($conn->query($sql_update_role) === TRUE) {
        echo "Rola użytkownika została zmieniona.";
    } else {
        echo "Błąd zmiany roli: " . $conn->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];

    $sql_delete_user_orders = "DELETE FROM orders WHERE user_id = $user_id";
    if ($conn->query($sql_delete_user_orders) === TRUE) {
        $sql_delete_user_comments = "DELETE FROM comments WHERE user_id = $user_id";
        if ($conn->query($sql_delete_user_comments) === TRUE) {
            $sql_delete_user = "DELETE FROM users WHERE id = $user_id";
            if ($conn->query($sql_delete_user) === TRUE) {
                echo "Użytkownik został usunięty pomyślnie.";
            } else {
                echo "Błąd usuwania użytkownika: " . $conn->error;
            }
        } else {
            echo "Błąd usuwania komentarzy użytkownika: " . $conn->error;
        }
    } else {
        echo "Błąd usuwania zamówień użytkownika: " . $conn->error;
    }
}

$sql_orders = "SELECT * FROM orders WHERE status = 'pending'";
$result_orders = $conn->query($sql_orders);
$sql_orders2 = "SELECT * FROM orders";
$result_all_orders = $conn->query($sql_orders2);
$sql_products = "SELECT * FROM products";
$result_products = $conn->query($sql_products);
$sql_users = "SELECT * FROM users";
$result_users = $conn->query($sql_users);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel administracyjny</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <h1>Panel administracyjny</h1>
    <nav>
        <a href="index.php">Strona główna</a>
        <a href="cart.php">Koszyk</a>
        <a href="logout.php">Wyloguj</a>
    </nav>
</header>
<main>
    <h2>Dodaj produkt</h2>
    <form action="admin.php" method="post" enctype="multipart/form-data">
        <label for="title">Tytuł:</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <label for="price">Cena:</label><br>
        <input type="number" id="price" name="price" step="0.01" required><br><br>

        <label for="quantity">Ilość:</label><br>
        <input type="number" id="quantity" name="quantity" required><br><br>

        <label for="description">Opis:</label><br>
        <textarea id="description" name="description" rows="4" required></textarea><br><br>

        <label for="image">Obrazek:</label><br>
        <input type="file" id="image" name="image" accept="image/*" required><br><br>

        <button type="submit" name="add_product">Dodaj produkt</button>
    </form>

    <?php if ($_SESSION['user']['role'] == 'admin'): ?>
        <h2>Usuń produkt</h2>
        <form action="admin.php" method="post">
            <label for="product_id">ID produktu do usunięcia:</label>
            <input type="text" id="product_id" name="product_id" required>
            <button type="submit" name="delete_product">Usuń produkt</button>
        </form>
    <?php endif; ?>

    <?php if ($_SESSION['user']['role'] == 'seller' || $_SESSION['user']['role'] == 'admin'): ?>
        <h2>Lista zamówień do realizacji</h2>
        <table border="2">
            <thead>
            <tr>
                <th>ID Zamówienia</th>
                <th>ID Użytkownika</th>
                <th>ID Produktu</th>
                <th>Ilość</th>
                <th>Status</th>
                <th>Data utworzenia</th>
                <th>Akcje</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = $result_orders->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['product_id']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td>
                        <form action="admin.php" method="post">
                            <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="complete_order">Zrealizuj zamówienie</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <?php if ($_SESSION['user']['role'] == 'admin'): ?>
        <h2>Lista wszystkich zamówień</h2>
        <table border="2">
            <thead>
            <tr>
                <th>ID Zamówienia</th>
                <th>ID Użytkownika</th>
                <th>ID Produktu</th>
                <th>Ilość</th>
                <th>Status</th>
                <th>Data utworzenia</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = $result_all_orders->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['product_id']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <?php if ($_SESSION['user']['role'] == 'admin'): ?>
        <h2>Lista użytkowników</h2>
        <table border="2">
            <thead>
            <tr>
                <th>ID Użytkownika</th>
                <th>Nazwa użytkownika</th>
                <th>Email</th>
                <th>Rola</th>
                <th>Data utworzenia</th>
                <th>Akcje</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = $result_users->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['role']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td>
                        <form action="admin.php" method="post" style="display:inline-block;">
                            <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                            <select name="new_role">
                                <option value="admin" <?php if ($row['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                                <option value="seller" <?php if ($row['role'] == 'seller') echo 'selected'; ?>>Seller</option>
                                <option value="user" <?php if ($row['role'] == 'user') echo 'selected'; ?>>User</option>
                            </select>
                            <button type="submit" name="change_role">Zmień rolę</button>
                        </form>
                        <form action="admin.php" method="post" style="display:inline-block;">
                            <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="delete_user">Usuń użytkownika</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    <?php endif; ?>
</main>
</body>
</html>
