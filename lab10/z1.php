<?php
$maxVisits = 5;
if (isset($_POST['reset'])) {
    setcookie("visitCount", 0);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
if (isset($_COOKIE['visitCount'])) {
    $visitCount = $_COOKIE['visitCount'] + 1;
} else {
    $visitCount = 1;
}
setcookie("visitCount", $visitCount);
?>
<!DOCTYPE html>
<html>
<head>
    <title>z1</title>
</head>
<body>
     Liczba odwiedzin: <strong><?php echo $visitCount; ?></strong>
    <form method="post">
        <button type="submit" name="reset">Reset</button>
    </form>
</body>
</html>
<?php
if ($visitCount > $maxVisits){
    echo "liczba odwiedzin wieksza od $maxVisits";
    }
if ($visitCount == $maxVisits){
    echo "Gratulacje jesteś $maxVisits odwiedzającym";
}
?>
