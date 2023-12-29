<?php
require_once 'functions.php';
use MongoDB\BSON\ObjectID;

$db = get_db();

if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

$ileMabyc = 3;
$start_from = ($page - 1) * 3;
$opts = ['skip' => $start_from, 'limit' => $ileMabyc];
$kursor = $db->zdjecia->find();
$ilosc_pozycji = iterator_count($kursor);
$ilosc_stron = ceil($ilosc_pozycji / $ileMabyc);


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/huj.css">
    <title>Galeria</title>
</head>

<body class="tlo">
    <header class="tlo">
        <h1 class="srodek podnav rozmiargigant">Stwórz galerię z własnym kotkiem !</h1>
    </header>
    <main>
        <div class="srodek">
            <a href="upload.php" class="tekstlink srodek">Dodaj zdjęcie</a>
            <?php include 'sprawdz.php'; ?>
        </div>
        <section>
            <div class="zdjecia ikonki">
                <?php
                $zdjecia = $db->zdjecia->find([], $opts);
                foreach ($zdjecia as $imageDB) {
                    $id = $imageDB['_id'];
                    ?>
                    <div class="podnav odstep bialy">
                        <a href="<?= $imageDB['wodny']; ?>" target="_blank">
                            <img src="<?= $imageDB['mini']; ?>" alt="Miniatura">
                        </a>
                        <p>Autor:
                            <?= $imageDB['autor'] ?> Tytuł:
                            <?= $imageDB['nazwa'] ?>
                        </p>
                        <a href="usun.php?id=<?= $id ?>" class="tekstlink">Usun</a>
                    </div>
                <?php } ?>
            </div>
        </section>
        <div class ="srodek">
            <?php
            for ($i = 1; $i <= $ilosc_stron; $i++) {
                ?>  
                <a href="index.php?page=<?= $i ?>" class ="t2">
                    <?= $i ?>
                </a>
            <?php }
            ?>
        </div>
        <div>
            <h2 class="tlo rozmiartytul podnav test">
                Zaloguj się, by nie stracić swojej pracy
            </h2>
        </div>
    </main>
    <footer class="tlo">
        <h6>Cyprian Hałas</h6>
    </footer>
</body>

</html>