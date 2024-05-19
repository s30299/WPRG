<html>
<head>
    <meta charset="utf-8" />
    <title>z2</title>

</head>
<body>
<div>
    <form method="POST">
        <h5 >Podaj scieżkę</h5>
        <input name="sciezka" size="50" value="..\">
        <br>
        <h5 >Podaj nazwe katalogu</h5>
        <input name="nazwa" size="50" value="lab9">
        <br>
        <h5 >Wybierz operacje </h5>
        <select name="akcja" size="1" >
            <option value=1 selected>-read</option>
            <option value=2><br>-delete</br></option>
            <option value=3>-create</option>
        </select>
        <br>&nbsp;
        <input type="submit" value="Wykonaj">
    </form>
</div>
</body>
</html>
<?php
if (!empty($_POST['sciezka'])&&!empty($_POST['nazwa'])) {
    $sciezka = $_POST['sciezka'];
    $name = $_POST['nazwa'];
    $question = substr($sciezka, strlen($_POST['sciezka'])-1, 1);
    if($question != "\\"){
        $sciezka=$sciezka."\\";
    }
    $dir = $sciezka.$name;
    if($_POST['akcja'] == "1") {
        if (!($fd = opendir($dir))){
            exit("Nie mogę otworzyć katalogu $dir");
        }
        $arr = scandir("$dir");
        foreach ($arr as $file) {
            if ($file != '.' && $file != '..')
                echo "$file<br/>";
        }
    }
    if($_POST['akcja'] == "3") {
        if (file_exists($dir)){
            echo "Katalog już istnieje";
            exit();
        }
        mkdir($dir,0777,true);
    }
    if($_POST['akcja'] == "2") {
        if (!file_exists($dir)){
            echo "Katalog nie istnieje";
            exit();
        }
        rmdir($dir);
    }
} else {
    echo "Błednie podane!<br>";
}
?>