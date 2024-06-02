<?php
class Cart{
    private array $products;
    function __construct(){
        $this->products = [];
    }
    public function addProduct(Product $product){
        $this->products[] = $product;
    }
    public function removeProduct(Product $product){
        $key = array_search($product, $this->products);
        if($key !== false){
            unset($this->products[$key]);
        }
    }
    public function getTotalPrice(){
        $total = 0;
        foreach($this->products as $product){
            $total += $product->getPrice();
        }
        return $total;
    }
    public function __toString(){
        $tekst ="";
        foreach($this->products as $product){
            $tekst .= $product."<br>";
        }
        return "Products in cart:<br>".$tekst.$this->getTotalPrice();
    }
}