<?php
trait Speed {
    protected $speed = 0;
    public function increaseSpeed() {
        $this->speed++;
    }
    public function decreaseSpeed() {
        $this->speed--;
    }
}
class Car {
    use Speed;
    function start(){
        $this->speed=0;
    }
    function getSpeed(){
        echo $this->speed."<br>";
    }
}
$car = new Car();
$car->start();
$car->getSpeed();
$car->increaseSpeed();
$car->getSpeed();
$car->increaseSpeed();
$car->getSpeed();
$car->start();
$car->getSpeed();
