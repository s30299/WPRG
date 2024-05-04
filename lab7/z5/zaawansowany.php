<?php
if (!empty($_POST['liczba1'])) {
    if (is_numeric($_POST['liczba1'])) {
        echo "Odpowiedź: ";
        switch ($_POST['metoda']) {
            case 1:
                echo cos($_POST['liczba1']);
                break;
            case 2:
                echo sin($_POST['liczba1']);
                break;
            case 3:
                echo tan($_POST['liczba1']);
                break;
            case 4:
                echo bindec($_POST['liczba1']);
                break;
            case 5:
                echo decbin($_POST['liczba1']);
                break;
            case 6:
                echo dechex($_POST['liczba1']);
                break;
            case 7:
                echo hexdec($_POST['liczba1']);
                break;
        }
    } else {

        echo "Błędne dane! Jedna lub obie liczby są niepoprawne!<br>";
    }
} else {
    echo "Brak danych! Jedna lub obie liczby nie zostały podane!<br>";
}
?>