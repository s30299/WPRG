<?php
include 'config.php';
session_start();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Sklep internetowy</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <h1>Witamy w naszym sklepie internetowym</h1>
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
    <h2>Produkty</h2>
    <div class="products">
        <?php
        $sql = "SELECT p.*, IFNULL(AVG(c.rating), '?') AS average_rating
                FROM products p
                LEFT JOIN comments c ON p.id = c.product_id
                GROUP BY p.id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='product'>
                        <h3>{$row['title']}<br>ID: {$row['id']}</h3>
                        <img src='{$row['image']}' alt='{$row['title']}'>
                        <p>Cena: {$row['price']} zł</p>
                        <p>Ocena: {$row['average_rating']}</p>
                        <p>Ilość: {$row['quantity']}</p>
                        <p>{$row['description']}</p>
                        <form method='post' action='cart.php'>
                            <input type='hidden' name='product_id' value='{$row['id']}'>
                            <input type='hidden' name='action' value='add'>
                            <button type='submit'>Dodaj do koszyka</button>
                        </form>";

                echo "<form method='post' action='comment.php'>
                        <input type='hidden' name='product_id' value='{$row['id']}'>
                        <label for='rating'>Ocena:</label>
                        <select name='rating' required>
                            <option value='1'>1</option>
                            <option value='2'>2</option>
                            <option value='3'>3</option>
                            <option value='4'>4</option>
                            <option value='5'>5</option>
                        </select>
                        <label for='comment'>Komentarz:</label>
                        <textarea name='comment' required></textarea>
                        <button type='submit'>Dodaj komentarz</button>
                    </form>";

                $product_id = $row['id'];
                $sql_comments = "SELECT c.rating, c.comment, c.created_at, u.username 
                                 FROM comments c 
                                 LEFT JOIN users u ON c.user_id = u.id 
                                 WHERE c.product_id = $product_id";
                $result_comments = $conn->query($sql_comments);

                if ($result_comments->num_rows > 0) {
                    echo "<div class='comments'><h4>Komentarze:</h4>";
                    while ($comment_row = $result_comments->fetch_assoc()) {
                        $username = $comment_row['username'] ? $comment_row['username'] : 'guest';
                        echo "<p><strong>{$username}</strong> ({$comment_row['rating']}/5): {$comment_row['comment']} <em>{$comment_row['created_at']}</em></p>";
                    }
                    echo "</div>";
                }

                echo "</div>";
            }
        } else {
            echo "Brak produktów w sklepie.";
        }
        ?>
    </div>
</main>
</body>
</html>
