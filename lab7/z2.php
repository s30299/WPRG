<html>
<head>
    <meta charset="utf-8" />
    <title>z2</title>
</head>
<body>
<?php

$tablica = array(0,1,2,3,4,5,6,7,8,9,10);
$position = 5;
error_reporting(E_ERROR | E_PARSE);

function dollar($a,$tab){
    if($a>sizeof($tab)){
        echo "Blad";
        return;
    }
    $temp=$tab;
    $tab[$a-1]="$";
    for($a;$a<sizeof($tab);$a++){
        $tab[$a]=$temp[$a-1];
    }
    $temp=$temp[$a-1];
    array_push($tab,$temp);
    foreach ($tab as $klucz => $dana)
    {
        echo $dana."<br>";
    }
}
dollar($position,$tablica);

?>
</body>
</html>