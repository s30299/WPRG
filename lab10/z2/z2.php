<?php
$vote = 0;
if (isset($_POST['glosuj'])) {
    setcookie("visitCount", 1);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
if (isset($_COOKIE['visitCount'])) {
    $currentVote = $_COOKIE['visitCount'];
}else{
    $currentVote = $vote;
}
setcookie("visitCount", $currentVote);


if ($currentVote != $vote){
    echo "Już głosowałeś<br>";
}else{
    include "glosowanie.html";
}
?>
