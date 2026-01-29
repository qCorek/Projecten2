<?php
// auteur: Vul hier je naam in
// functie: verwijder een fiets op basis van de id

require_once 'config.php';
require_once 'Database.php';
require_once 'functions.php'; // hier staat class Fiets

if (isset($_GET['id'])) {

    $fiets = new Fiets(); // 👈 object maken

    if ($fiets->deleteRecord($_GET['id']) === true) {
        echo '<script>alert("Fietscode: ' . $_GET['id'] . ' is verwijderd")</script>';
        echo "<script> location.replace('index.php'); </script>";
    } else {
        echo '<script>alert("Fiets is NIET verwijderd")</script>';
    }
}
