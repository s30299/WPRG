<html>
<head>
    <title>z3</title>
</head>
<body>
<?php
$a = [2,2];
$b = [3,3];
$rows=2;
error_reporting(E_ERROR | E_PARSE);
function macierz($a, $b,$rows) {
    $temp=0;
    for($i=0;$i<$rows;$i++){
        $temp+=$a[$i]*$b[$i];
    }
    echo "<br>";
    echo $temp;
    echo "<br>";
}
macierz($a,$b,$rows);
?>
</body>
</html>
