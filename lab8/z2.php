<html>
<head>
    <meta charset="utf-8" />
    <title>z2</title>
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
    <h1 class="text">Ciąg liczb</h1>
</div>
<hr>
<div>
    <form method="POST">
        <h2 class="text">Podaj ciąg liczb</h2>
        <input name="liczba" size="50">
        <br><br>&nbsp;
        <input type="submit" value="Wykonaj">
    </form>
</div>

</body>
</html>
<?php
if (!empty($_POST['liczba'])) {
    echo "Odpowiedź: ";
    for ($i=0; $i < strlen($_POST['liczba']); $i++) {
        $unwantedChars = ['\\','/',':','*','?','"','<','>','|','+','-'];
        if(preg_match("/[\\/:*?\"<>|+\-]/", $_POST['liczba'][$i])){
            continue;
        }
        echo $_POST['liczba'][$i];
    }
} else {
    echo "Podaj ciąg!<br>";
}
?>