<?php
// auteur: umit ali akbas
// functie: Verkooporder class

require '../../vendor/autoload.php';

use Bas\classes\Klant;
use Bas\classes\Verkooporder;

$klant = new Klant();
$order = new Verkooporder();

$melding = "";

// =========================
// VERKOOPORDER TOEVOEGEN
// =========================
if(isset($_POST["insert_order"])){

    $order->insertOrder(
        $_POST["klantId"],
        $_POST["artId"],
        $_POST["datum"],
        $_POST["aantal"],
        $_POST["status"]
    );

    $melding = "Order succesvol toegevoegd!";
}

// =========================
// MELDING NA UPDATE/DELETE
// =========================
if(isset($_GET['msg'])){
    if($_GET['msg'] == 'updated'){
        $melding = "Order bijgewerkt!";
    }
    if($_GET['msg'] == 'deleted'){
        $melding = "Order verwijderd!";
    }
}

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
    <title>CRUD Klant + Verkooporder</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<h1>CRUD Klant</h1>

<nav>
    <a href='../index.html'>Home</a><br>
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

<hr>

<h1>CRUD Verkooporder</h1>

<h2>Nieuwe Verkooporder</h2>

<?php
// melding tonen
if($melding != ""){
    echo "<p style='color:green;'>$melding</p>";
}
?>

<form method="post">

<label>KlantID:</label>
<input type="number" name="klantId" required><br>

<label>ArtikelID:</label>
<input type="number" name="artId" required><br>

<label>Datum:</label>
<input type="date" name="datum" required><br>

<label>Aantal:</label>
<input type="number" name="aantal" required><br>

<label>Status:</label>
<input type="number" name="status" required><br><br>

<input type="submit" name="insert_order" value="Toevoegen order">

</form>

<br>

<?php
$orders = $order->getOrders();
$order->showTable($orders);
?>

</body>
</html>