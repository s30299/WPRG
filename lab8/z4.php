<html>
<head>
    <meta charset="utf-8" />
    <title>z4</title>
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
    <h1 class="text">Tekst</h1>
</div>
<hr>
<div>
    <form method="POST">
        <h2 class="text">Podaj tekst</h2>
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
    for ($i=0; $i < strlen($_POST['slowo']); $i++) {
        if (preg_match("/[aiueoAIUEO]/", $_POST['slowo'][$i])) {
            $licznik++;
        }
    }
    echo $licznik;
} else {
    echo "Podaj tekst!<br>";
}
?>