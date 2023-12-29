<?php
require_once 'functions.php';
use MongoDB\BSON\ObjectID;

if (isset($_GET['status']))
{
    if ($_GET['status'] == 2)
    echo 'Błąd: Dozwolone są tylko pliki w formacie PNG lub JPG oraz plik przekracza maksymalny rozmiar (1 MB).';
else if ($_GET['status'] == 3)
    echo 'Błąd: Dozwolone są tylko pliki w formacie PNG lub JPG.';
else if ($_GET['status'] == 4)
    echo 'Błąd: Plik przekracza maksymalny rozmiar (1 MB).';
}
?>