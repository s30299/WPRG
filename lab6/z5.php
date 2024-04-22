<html>
<head>
    <title>z5</title>
</head>
<body>
<?php
$check=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
$sentence="The quick brown fox jumps over the lazy dog.";
error_reporting(E_ERROR | E_PARSE);

function pangram($what ,$a) {
    $str = $what;
    $chars = str_split($str);
    foreach ($chars as $char) {
        $a[(ord(strtolower($char))-97)]++;
    }
    for($i=0;$i<26;$i++){
        if($a[$i]==0){
            echo "false";
            return;
        }
    }
    echo "true";
}
pangram($sentence,$check);
?>
</body>
</html>
