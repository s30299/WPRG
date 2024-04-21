<html>
<head>
    <title>z4</title>
</head>
<body>
<?php
$a =12345;
function obliczanie($a) {
    while ($a>=10) {
        $temp=0;
        $check=1;
        $licz=1;
        while($licz<=$a){
            $check+=1;
            $licz*=10;
        }
        $a=strval($a);
        for($i=0;$i<$check;$i++){
            $temp+=intval($a[$i]);
        }
        $a=$temp;
    }
    echo $a;
    echo "<br>";
}
obliczanie($a);
?>
</body>
</html>