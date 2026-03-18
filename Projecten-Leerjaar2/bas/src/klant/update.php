<?php
require '../../vendor/autoload.php';
use Bas\classes\Klant;

$klant = new Klant;

// =========================
// UPDATE UITVOEREN
// =========================
if(isset($_POST["update"]) && $_POST["update"] == "Wijzigen"){

    // stuur alle POST data naar de functie
    $klant->updateKlant($_POST);

    echo '<script>alert("Klant gewijzigd")</script>';
    echo "<script> location.replace('read.php'); </script>";
    exit;
}

// =========================
// DATA OPHALEN
// =========================
if (isset($_GET['klantId'])){
    $row = $klant->getKlant($_GET['klantId']);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Update klant</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<h1>CRUD Klant</h1>
<h2>Wijzigen</h2>	

<form method="post">

<!-- ID (hidden) -->
<input type="hidden" name="klantId"
value="<?php echo $row['klantId']; ?>">

<!-- Naam -->
<label>Naam:</label>
<input type="text" name="klantnaam" required
value="<?php echo $row['klantNaam']; ?>"><br>

<!-- Email -->
<label>Email:</label>
<input type="email" name="klantemail" required
value="<?php echo $row['klantEmail']; ?>"><br>

<!-- Adres -->
<label>Adres:</label>
<input type="text" name="klantadres"
value="<?php echo $row['klantAdres']; ?>"><br>

<!-- Postcode -->
<label>Postcode:</label>
<input type="text" name="klantpostcode"
value="<?php echo $row['klantPostcode']; ?>"><br>

<!-- Woonplaats -->
<label>Woonplaats:</label>
<input type="text" name="klantwoonplaats"
value="<?php echo $row['klantWoonplaats']; ?>"><br><br>

<input type="submit" name="update" value="Wijzigen">

</form>

<br>
<a href="read.php">Terug</a>

</body>
</html>

<?php
} else {
    echo "Geen klantId opgegeven<br>";
}
?>