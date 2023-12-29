<?php

require_once 'functions.php';
use MongoDB\BSON\ObjectID;
$db = get_db();

$upload_dir = "../web/images/";

if ($mime_type == "image/jpeg") {
    $nowaNazwa = $tytul . '.jpg';
    $destinationPath = $upload_dir . $nowaNazwa;
    if (move_uploaded_file($TmpName, $destinationPath)) {
        $oryginalneZdjecie = imagecreatefromjpeg($destinationPath);
        dodajZnakWodny($oryginalneZdjecie, $znakWodny);
        zapiszObrazjpg($oryginalneZdjecie, "wodny_$nowaNazwa");
        $miniaturka = przeskalujObraz($oryginalneZdjecie, 200, 125);
        zapiszObrazjpg($miniaturka, "mini_$nowaNazwa");
        $imageDB = ['nazwa' => $tytul,
        'autor' => $autor,
        'mini' => "images/" . "mini_" . $nowaNazwa,
        'wodny' => "images/" . "wodny_" . $nowaNazwa];
        $db->zdjecia->insertOne($imageDB);
    }
} else if ($mime_type == "image/png") {
    $nowaNazwa = $tytul . '.png';
    $destinationPath = $upload_dir . $nowaNazwa;
    if (move_uploaded_file($TmpName, $destinationPath)) {
        $oryginalneZdjecie = imagecreatefrompng($destinationPath);
        dodajZnakWodny($oryginalneZdjecie, $znakWodny);
        zapiszObrazpng($oryginalneZdjecie, "wodny_$nowaNazwa");
        $miniaturka = przeskalujObraz($oryginalneZdjecie, 200, 125);
        zapiszObrazpng($miniaturka, "mini_$nowaNazwa");
        $imageDB = ['nazwa' => $tytul,
        'autor' => $autor,
        'mini' => "images/" . "mini_" . $nowaNazwa,
        'wodny' => "images/" . "wodny_" . $nowaNazwa];
        $db->zdjecia->insertOne($imageDB);
    }
}
header("Location: index.php");
exit;
?>