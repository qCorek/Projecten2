
<?php
// auteur: umit ali akbas
// functie: Klant overzicht + zoeken

require '../../vendor/autoload.php';

use Bas\classes\Klant;

$klant = new Klant();

// =========================
// KLANT ZOEKEN OF LIJST
// =========================
if(isset($_POST['zoeken'])){
    $result = $klant->zoekKlant($_POST['zoeknaam']);
} else {
    $result = $klant->getKlanten();
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>CRUD Klant</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<h1>CRUD Klant</h1>

<nav>
    <a href='../index.php'>Home</a><br>
    <a href='insert.php'>Toevoegen nieuwe klant</a><br>
</nav>

<!-- 🔍 ZOEKEN KLANT -->
<h2>Zoeken op klantnaam</h2>

<form method="post">
    <input type="text" name="zoeknaam" placeholder="Voer naam in">
    <input type="submit" name="zoeken" value="Zoeken">
</form>

<br>

<?php
$klant->showTable($result);
?>

</body>
</html>

