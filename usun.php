<?php
require_once 'functions.php';
use MongoDB\BSON\ObjectID;
$db = get_db();

$id = $_GET['id'];
$db->zdjecia->deleteOne(['_id' => new ObjectID($id)]);

header("Location: index.php");


?>