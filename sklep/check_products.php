<?php
global $conn;
include 'config.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - Title: " . $row["title"] . " - Price: " . $row["price"] . "<br>";
    }
} else {
    echo "Brak produktów w bazie danych.";
}

$conn->close();
?>
