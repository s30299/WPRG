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
    <h1 class="text">Kalkulator</h1>
</div>
<hr>
<div>
    <form action="prosty.php" method="POST">

    <h2 class="text">Prosty</h2>
        <input name="liczba1">
    <select name="metoda" size="1">
        <option value=1 selected>Dodawanie</option>
        <option value=2>Odejmowanie</option>
        <option value=3>Mnożenie</option>
        <option value=4>Dzielenie</option>
    </select>
        <input name="liczba2">
        <br>&nbsp;
        <input type="submit" value="Oblicz">
    </form>
</div>

<hr>
<div>
    <form action="zaawansowany.php" method="POST">

        <h2 class="text">Zaawansowany</h2>
        <input name="liczba1">
        <select name="metoda" size="1">
            <option value=1 selected>Cosinus</option>
            <option value=2>Sinus</option>
            <option value=3>Tangens</option>
            <option value=4>Binarne na dziesiętne</option>
            <option value=5>Dziesiętne na binarne</option>
            <option value=6>Dziesiętne na szesnastkowe</option>
            <option value=7>Szesnastkowe na dziesiętne</option>
        </select>
        <br>&nbsp;
        <input type="submit" value="Oblicz">
    </form>

</div>
</body>
</html>
