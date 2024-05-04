<html>
<head>
    <meta charset="utf-8" />
    <title>z3</title>
</head>
<body>
<?php

#
$a = 2;
$b = 15;
$c = 1;
$d = 13;
error_reporting(E_ERROR | E_PARSE);

function fajnyKod($a,$b,$c,$d){
    $tab=array();

    for($a;$a<=$b;$a++){
        $tab[$a]=$c;
        $c++;
        if($c>$d){
            $c=$d;
        }
    }
    foreach ($tab as $klucz => $dana)
    {
        echo $klucz." ".$dana."<br>";
    }
}
fajnyKod($a,$b,$c,$d);

?>
</body>
</html>