<html>
<head>
    <meta charset="utf-8" />
    <title>z4</title>

</head>
<body>
</body>
</html>
<?php
if(!file_exists("odnosniki.txt")){
    $fd = fopen("odnosniki.txt", "wb");
    fwrite($fd, "google.com;fajna strona do wyszukiwania\n");
    fwrite($fd, "youtube.com;fajna strona do oglądania\n");
    fwrite($fd, "jakasStrona.com;fajna strona do jakis rzeczy");
}
if (!$fd = fopen('odnosniki.txt', 'r')){
    echo "Nie mogę otworzyć pliku odnosniki.txt";
}
else{
    while(!feof($fd)){
        $str = fgets($fd);
        $str = trim($str);
        $i=0;
        while(substr($str,$i,1)!=';'){
            $i++;
        }
        $str1=substr($str,0,$i);
        $str2=substr($str,$i+1,strlen($str));
        echo "Adres: ".$str1."<br>";
        echo "Opis: ".$str2."<br>";
    }
}

?>