<?php
class Product{
    private string $name;
    private float $price;
    private int $quantity;
    function __construct(string $name, float $price, int $quantity){
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
    }
    public function getName(): string{
        return $this->name;
    }
    public function getPrice(): float{
        return $this->price;
    }
    public function getQuantity(): int{
        return $this->quantity;
    }
    public function setName(string $name): void{
        $this->name = $name;
    }
    public function setPrice(float $price): void{
        $this->price = $price;
    }
    public function setQuantity(int $quantity): void{
        $this->quantity = $quantity;
    }
    public function __toString(){
        return "Product: ".$this->name.", Price: ".$this->price.", Quantity: ".$this->quantity;
    }
}