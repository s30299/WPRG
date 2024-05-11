<html>
<head>
    <meta charset="utf-8" />
    <title>z1</title>
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
    echo strtoupper($_POST['slowo']);
    echo "<br>";
    echo strtolower($_POST['slowo']);
    echo "<br>";
    $_POST['slowo']=strtolower($_POST['slowo']);
    echo ucfirst($_POST['slowo']);
    echo "<br>";
    for ($i=0; $i < strlen($_POST['slowo']); $i++) {
        if ($_POST['slowo'][$i-1] == ' ' || $i==0) {
            echo strtoupper($_POST['slowo'][$i]);
            continue;
        }
        echo $_POST['slowo'][$i];
    }
} else {
    echo "Podaj tekst!<br>";
}
?>