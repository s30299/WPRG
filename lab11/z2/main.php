<?php
require_once "C:\Users\MojPC\PhpstormProjects\zadania\lab11\z2\Product.php";
require_once "C:\Users\MojPC\PhpstormProjects\zadania\lab11\z2\Cart.php";
$product1 = new Product("Laptop",1500,1);
$product2 = new Product("TV",1000,4);
$product3 = new Product("Bed",250,3);
$cart = new Cart();
$cart->addProduct($product1);
$cart->addProduct($product2);
$cart->addProduct($product3);
echo $cart;