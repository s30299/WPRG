<?php
if (!empty($_POST['liczba1']) && !empty($_POST['liczba2'])) {
    if (is_numeric($_POST['liczba1']) &&
        is_numeric($_POST['liczba2'])) {
        echo "Odpowiedź: ";
        switch ($_POST['metoda']) {
            case 1:
                echo $_POST['liczba1']+$_POST['liczba2'];
                break;
            case 2:
                echo $_POST['liczba1']-$_POST['liczba2'];
                break;
            case 3:
                echo $_POST['liczba1']*$_POST['liczba2'];
                break;
            case 4:
                echo $_POST['liczba1']/$_POST['liczba2'];
                break;
        }
    } else {

        echo "Błędne dane! Jedna lub obie liczby są niepoprawne!<br>";
    }
} else {
    echo "Brak danych! Jedna lub obie liczby nie zostały podane!<br>";
}
?>