<?php 
// auteur: studentnaam
// functie: verwijderen klant

require '../../vendor/autoload.php';
use Bas\classes\Klant;

if(isset($_POST["verwijderen"])){

    // Maak een object Klant
    $klant = new Klant();

    // Haal klantId uit de URL
    $klantId = $_GET['klantId'];

    // Delete klant
    $klant->deleteKlant($klantId);

    echo '<script>alert("Klant verwijderd")</script>';
    echo "<script> location.replace('read.php'); </script>";
}
?>