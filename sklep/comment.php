<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $user_id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : null;

    $sql = "INSERT INTO comments (product_id, user_id, rating, comment) 
            VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiis", $product_id, $user_id, $rating, $comment);

    if ($stmt->execute()) {
        echo "Komentarz został dodany pomyślnie.";
    } else {
        echo "Błąd dodawania komentarza: " . $conn->error;
    }

    $stmt->close();
    header("Location: index.php");
}
?>
