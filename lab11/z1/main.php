<?php
require_once "C:\Users\MojPC\PhpstormProjects\zadania\lab11\z1\NoweAuto.php";
require_once "C:\Users\MojPC\PhpstormProjects\zadania\lab11\z1\AutoZDodatkami.php";
require_once "C:\Users\MojPC\PhpstormProjects\zadania\lab11\z1\Ubezpieczenie.php";
$auto = new NoweAuto("Mercedes",50000,4.28);
$autoDodatki = new AutoZDodatkami(5000,5000,5000,$auto->GetModel(),$auto->GetCena(),$auto->GetKurs());
$ubezpieczenie = new Ubezpieczenie(0.05,5,$autoDodatki);
echo $auto->ObliczCene()."<br>";
echo $autoDodatki->ObliczCene()."<br>";
echo $ubezpieczenie->ObliczCene()."<br>";