<?php
global $conn;
include 'config.php';

$sample_products = [
    [
        'title' => 'Produkt 1',
        'image' => 'uploads/product1.jpg',
        'price' => 49.99,
        'quantity' => 10,
        'description' => 'Opis produktu 1'
    ],
    [
        'title' => 'Produkt 2',
        'image' => 'uploads/product2.jpg',
        'price' => 89.99,
        'quantity' => 5,
        'description' => 'Opis produktu 2'
    ],
    [
        'title' => 'Produkt 3',
        'image' => 'uploads/product3.jpg',
        'price' => 29.99,
        'quantity' => 20,
        'description' => 'Opis produktu 3'
    ]
];

foreach ($sample_products as $product) {
    $sql = "INSERT INTO products (title, image, price, quantity, description) VALUES (
        '{$product['title']}', '{$product['image']}', {$product['price']}, {$product['quantity']}, '{$product['description']}')";
    if ($conn->query($sql) === TRUE) {
        echo "Przykładowy produkt '{$product['title']}' został dodany.<br>";
    } else {
        echo "Błąd dodawania produktu '{$product['title']}': " . $conn->error . "<br>";
    }
}

//$password = password_hash('admin', PASSWORD_DEFAULT);
//$sql = "INSERT INTO users (username, password, email,role) VALUES ('admin',$password, 'email@email','admin')";
//$conn->query($sql);
//$password = password_hash('seller', PASSWORD_DEFAULT);
//$sql = "INSERT INTO users (username, password, email,role) VALUES ('seller', $password, 'seller@seller','seller')";
//$conn->query($sql);
//$password = password_hash('seller', PASSWORD_DEFAULT);
//$sql = "INSERT INTO users (username, password, email,role) VALUES ('user', $password, 'user@user','user')";
//$conn->query($sql);
$conn->close();
?>
