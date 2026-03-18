<?php
require '../../vendor/autoload.php';

use Bas\classes\Klant;

if(isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen"){

    $klantnaam = $_POST["klantnaam"];
    $klantemail = $_POST["klantemail"];
    $klantadres = $_POST["klantadres"];
    $klantpostcode = $_POST["klantpostcode"];
    $klantwoonplaats = $_POST["klantwoonplaats"];

    $klant = new Klant();

    $klant->insertKlant(
        $klantnaam,
        $klantemail,
        $klantadres,
        $klantpostcode,
        $klantwoonplaats
    );

    header("Location: read.php");
    exit;
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