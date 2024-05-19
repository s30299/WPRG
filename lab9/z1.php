<html>
<head>
    <meta charset="utf-8" />
    <title>z1</title>

</head>
<body>
<div>
    <h1 >Podaj date urodzenia</h1>
</div>
<hr>
<div>
    <form method="POST">
        <h2 >Podaj date urodzenia</h2>
        <input name="slowo" size="50" type="date">
        <br>
        <br>&nbsp;
        <input type="submit" value="Wykonaj">
    </form>
</div>
</body>
</html>
<?php
$data = getdate();
if (!empty($_POST['slowo'])) {
    echo "Wybrana data: " .$_POST['slowo']."<br>";
    echo "Dzień tygodnia: " .date("l", strtotime($_POST['slowo']))."<br>";
    $r1= date("o", strtotime($_POST['slowo']));
    $r2= date("o",);
    echo "Wiek: " .$r2-$r1."<br>";
    $day = date("z");
    if(date("z",strtotime($_POST['slowo']))-$day>=0){
        echo "Liczba dni do przyszłych urodziń: ".date("z",strtotime($_POST['slowo']))-$day;
    }else{
        echo "Liczba dni do przyszłych urodziń: ".date("z",strtotime($_POST['slowo']))-$day+365;
    }
} else {
    echo "Błednie podane!<br>";
}
?>