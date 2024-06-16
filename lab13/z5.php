<?php
interface Animal{
    function makeSound();
    function eat();
}
class Dog implements Animal{
    function makeSound(){
        echo "Woof!";
    }
    function eat(){
        echo "The dog is eating.";
    }
}
$dog = new Dog();
$dog->makeSound();
echo "<br>";
$dog->eat();