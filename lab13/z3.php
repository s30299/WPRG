<?php
trait A {
    public function smallTalk() {
        echo 'a';
    }
    public function bigTalk() {
        echo 'A';
    }
}
trait B {
    public function smallTalk() {
        echo 'b';
    }
    public function bigTalk() {
        echo 'B';
    }
}
class Zadania{
    use A, B {
        A::smallTalk insteadof B;
        A::bigTalk insteadof B;
        B::smallTalk as smallB;
        B::bigTalk as bigB;
    }
}
$zadanie = new Zadania();
$zadanie->bigTalk();
$zadanie->smallTalk();
$zadanie->bigB();
$zadanie->smallB();