<?php
require '../../vendor/autoload.php';

use Bas\classes\Klant;
use Bas\classes\Verkooporder;

// =========================
// KLANT TOEVOEGEN
// =========================
if(isset($_POST["insert_klant"])){

    $klant = new Klant();

    $klant->insertKlant(
        $_POST["klantnaam"],
        $_POST["klantemail"],
        $_POST["klantadres"],
        $_POST["klantpostcode"],
        $_POST["klantwoonplaats"]
    );

    echo "Klant toegevoegd!";
}

// =========================
// VERKOOPORDER TOEVOEGEN
// =========================
if(isset($_POST["insert_order"])){

    $order = new Verkooporder();

    $order->insertOrder(
        $_POST["klantId"],
        $_POST["artId"],
        $_POST["datum"],
        $_POST["aantal"],
        $_POST["status"]
    );

    echo "Order toegevoegd!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<h1>CRUD Klant</h1>
<h2>Toevoegen</h2>

<form method="post">

<label>Klantnaam:</label>
<input type="text" name="klantnaam" required>
<br>

<label>Klantemail:</label>
<input type="email" name="klantemail" required>
<br>

<label>Adres:</label>
<input type="text" name="klantadres" required>
<br>

<label>Postcode:</label>
<input type="text" name="klantpostcode">
<br>

<label>Woonplaats:</label>
<input type="text" name="klantwoonplaats">
<br><br>

<input type="submit" name="insert" value="Toevoegen">

</form>

<br>
<a href="read.php">Terug</a>

</body>
</html>