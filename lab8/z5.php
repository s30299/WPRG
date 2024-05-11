<html>
<head>
    <meta charset="utf-8" />
    <title>z5</title>
</head>
<style>
    body{
        background-color: black;
    }
    .text{
        color: grey;
    }
</style>
<body>
<div>
    <h1 class="text">Podaj ciąg</h1>
</div>
<hr>
<div>
    <form method="POST">
        <h2 class="text">Podaj ciąg</h2>
        <input name="slowo" size="50">
        <br>
        <br>&nbsp;
        <input type="submit" value="Wykonaj">
    </form>
</div>

</body>
</html>
<?php
if (!empty($_POST['slowo'])) {
    echo "Odpowiedź: ";
    $licznik=0;
    $przecinek=false;
    $litera=false;
    $licznikZnakow=0;
    for ($i=0; $i < strlen($_POST['slowo']); $i++) {
        if (preg_match("/,/", $_POST['slowo'][$i])) {
            $licznik++;
            $przecinek=true;
        }
        if(preg_match("/[a-zA-Z]/", $_POST['slowo'][$i])){
            $litera=true;
            echo "Podano błędny ciąg";
            break;
        }
        if($przecinek){
            $licznikZnakow++;
        }
        if($licznik>1){
            echo "Za dużo przecinków/',' .";
            break;
        }
    }
    $licznikZnakow--;
    if($licznik<2 && !$litera){
        echo $licznikZnakow;
    }
} else {
    echo "Błednie podane!<br>";
}
?>