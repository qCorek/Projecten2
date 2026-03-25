<?php 
require '../../vendor/autoload.php';
use Bas\classes\Klant;

if(isset($_POST["verwijderen"])){

    $klant = new Klant();
    $klantId = $_GET['klantId'];

    $result = $klant->deleteKlant($klantId);

    if($result){
        echo '<script>alert("Klant verwijderd")</script>';
    } else {
        echo '<script>alert("Klant kon NIET verwijderd worden (heeft orders)")</script>';
    }

    echo "<script> location.replace('read.php'); </script>";
}
?>