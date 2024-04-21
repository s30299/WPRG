<html>
<head>
    <title>z2</title>
</head>
<body>
<?php
$a = 10;
$b = 5;
$c = 4;
function ciag($x, $b, $c) {
    echo "ciąg arytmetyczny<br>";
    for($i=0;$i<$c;$i++) {
        echo ($i+1).". ";
        echo $x+($i*$b)."<br>";
    }
    echo "ciąg geometryczny<br>";
    echo (1).". ";
    echo $x."<br>";
    for($i=1;$i<$c;$i++) {
        echo ($i+1).". ";
        echo $x*($i*$b)."<br>";
    }
}
ciag($a,$b,$c);
?>
</body>
</html>