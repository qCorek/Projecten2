<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Klant</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<h1>CRUD Klant</h1>

<nav>
    <a href='../index.html'>Home</a><br>
    <a href='insert.php'>Toevoegen nieuwe klant</a><br><br>
</nav>

<!-- 🔍 ZOEKEN -->
<h2>Zoeken op klantnaam</h2>

<form method="post">
    <input type="text" name="zoeknaam" placeholder="Voer naam in">
    <input type="submit" name="zoeken" value="Zoeken">
</form>

<br>

<?php

require '../../vendor/autoload.php';
use Bas\classes\Klant;

$klant = new Klant();

// =========================
// ZOEKEN OF LIJST
// =========================
if(isset($_POST['zoeken'])){
    $result = $klant->zoekKlant($_POST['zoeknaam']);
    $klant->showTable($result);
} 
else {
    $lijst = $klant->getKlanten();
    $klant->showTable($lijst);
}

?>

</body>
</html>