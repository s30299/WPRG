<html>
<head>
    <meta charset="utf-8" />
    <title>z3</title>
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
        <br><br>
        <select name="metoda" size="1" >
            <option value=1 selected>Odwrócenie ciągu znaków</option>
            <option value=2>Zamiana wszystkich liter na wielkie</option>
            <option value=3>Zamiana wszystkich liter na małe.</option>
            <option value=4>Liczenie liczby znaków.</option>
            <option value=5>Usuwanie białych znaków z początku i końca ciągu.</option>
        </select>
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
    switch ($_POST['metoda']) {
        case 1:
            echo strrev($_POST['slowo']);
            break;
        case 2:
            echo strtoupper($_POST['slowo']);
            break;
        case 3:
            echo strtolower($_POST['slowo']);
            break;
        case 4:
            echo strlen($_POST['slowo']);
            break;
        case 5:
            echo trim($_POST['slowo']);
            break;
    }
} else {
    echo "Podaj tekst!<br>";
}
?>