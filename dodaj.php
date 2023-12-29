<?php
require_once 'functions.php';
use MongoDB\BSON\ObjectID;
function sprawdzRozmiar($rozmiar, $maxRozmiar)
{
    if ($rozmiar > $maxRozmiar) {
        return 1;
    }

    return null;
}


function sprawdzFormat($TmpName)
{
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $TmpName);

    if ($mime_type !== "image/jpeg" && $mime_type !== "image/png") {
        return array(1, null);
    }

    return array(null, $mime_type);
}

function przeskalujObraz($obraz, $szerokosc, $wysokosc)
{
    $nowyObraz = imagecreatetruecolor($szerokosc, $wysokosc);
    imagecopyresampled($nowyObraz, $obraz, 0, 0, 0, 0, $szerokosc, $wysokosc, imagesx($obraz), imagesy($obraz));

    return $nowyObraz;
}

function dodajZnakWodny($obraz, $znakWodny)
{
    $kolor = imagecolorallocate($obraz, 255, 255, 255);
    $czcionka = __DIR__ . '/static/arial.ttf';
    imagettftext($obraz, 12, 0, 10, 20, $kolor, $czcionka, $znakWodny);
}


function zapiszObrazjpg($obraz, $nazwa)
{
    $sciezka = __DIR__ . '/images/' . $nazwa;
    imagejpeg($obraz, $sciezka);
}

function zapiszObrazpng($obraz, $nazwa)
{
    $sciezka = __DIR__ . '/images/' . $nazwa;
    imagepng($obraz, $sciezka);
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['znak_wodny']) && !empty($_POST['tytul']) && !empty($_POST['autor'])) {
    $znakWodny = $_POST['znak_wodny'];
    $allowedExtensions = ["png", "jpg"];
    $maxRozmiar = 1024 * 1024;
    $nazwa = $_FILES["file"]["name"];
    $rozmiar = $_FILES["file"]["size"];
    $TmpName = $_FILES["file"]["tmp_name"];
    $autor = $_POST["autor"];
    $tytul = $_POST["tytul"];

    $rozmiarError = sprawdzRozmiar($rozmiar, $maxRozmiar);
    $formatWynik = sprawdzFormat($TmpName);
    $formatError = $formatWynik[0];
    $mime_type = $formatWynik[1];

    if ($rozmiarError == null && $formatError == null) {
        require("zapis.php");
    } else if ($rozmiarError == 1 && $formatError == 1) {
        header("Location: index.php?status=2");
    } else if ($formatError == 1) {
        header("Location: index.php?status=3");
    } else if ($rozmiarError == 1) {
        header("Location: index.php?status=4");
    }

}

?>