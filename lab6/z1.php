<html>
<head>
    <title>z1</title>
</head>
<body>
<?php
$a = 10;
$b = 60;
function pierwsze($a, $b) {
    if($a < $b) {
        $c = $a;
        $a = $b;
        $b = $c;
    }
    for($b;$b<=$a;$b++) {
        $temp=true;
        for($c=2;$c<$b;$c++) {
            if($b%$c==0) {
                $temp=false;
            }
        }
        if($temp){
            echo $b."<br>";
        }
    }
}
echo pierwsze($a, $b);
?>
</body>
</html>