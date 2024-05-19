<html>
<body>

<h1>Zmieniająca sie strona</h1>
<div>
<?php
$ip="888.8.8.8";
if($_SERVER['REMOTE_ADDR']==$ip){
include 'strona1.php';
}else{
    include 'strona2.php';
}
?>
</div>
</body>
</html>