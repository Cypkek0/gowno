<?php
require_once 'functions.php';
use MongoDB\BSON\ObjectID;

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/huj.css">
    <title>Upload</title>
</head>

<body class="tlo">
    <header>
    </header>
    <main>
        <div>
            <form action="dodaj.php" method="post" enctype="multipart/form-data">
                <label for="file">Dodaj zdjęcie:</label>
                <input type="file" name="file" id="file" accept=".png, .jpg">
                <label for="tekst">Dodaj znak wodny:</label>
                <input type="text" id="znak_wodny" name="znak_wodny" required>
                <label for="tekst">Dodaj tytuł:</label>
                <input type="text" id="tytul" name="tytul" required>
                <label for="tekst">Autor:</label>
                <input type="text" id="autor" name="autor" required>
                <input type="submit" value="Dodaj">
            </form>
        </div>
    </main>
    <footer>
    </footer>
</body>

</html>