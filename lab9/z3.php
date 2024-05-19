<html>
<head>
    <meta charset="utf-8" />
    <title>z3</title>

</head>
<body>
</body>
</html>
<?php
$str=0;
if(!file_exists("tekst.txt")){
    $fd = fopen("tekst.txt", "wb");
    fwrite($fd, 1);
}
if (!$fd = fopen('tekst.txt', 'r')){
    echo "fail";
}
else{
    $r = filesize("tekst.txt");
    $str = fread($fd,$r);
    echo $str;
    $str++;
    fclose($fd);
}
if (!$fd = fopen("tekst.txt", "wb")){
    echo "Nie mogę utworzyć pliku tekst.txt";
}
else{
    if (fwrite($fd, $str) === false){
        echo "Wystąpił błąd. Zapis nie został dokonany";
    }
}

?>