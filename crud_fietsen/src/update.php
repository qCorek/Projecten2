<?php
    // functie: update fiets
    // auteur: Vul hier je naam in

require_once 'config.php';
require_once 'Database.php';
require_once 'functions.php'; // hier staat class Fiets
    // Test of er op de wijzig-knop is gedrukt 
    if(isset($_POST['btn_wzg'])){
    $fiets = new Fiets(); // 👈 object maken

        // test of update gelukt is
        if($fiets->updateRecord($_POST) == true){
            echo "<script>alert('Fiets is gewijzigd')</script>";
        } else {
            echo '<script>alert("Fiets is NIET gewijzigd")</script>';
        }
    }

    // Test of id is meegegeven in de URL
    if(isset($_GET['id'])){  
        // Haal alle info van de betreffende id $_GET['id']
        $id = $_GET['id'];

        $fiets = new Fiets;
        $row = $fiets->getRecord($id);
      } else {
          echo "Geen id opgegeven<br>";
          exit;
      }
  ?> 


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Wijzig Fiets</title>
</head>
<body>
  <h2>Wijzig Fiets</h2>
  <form method="post">
    
    <input type="hidden" id="merk" name="id" required value="<?php echo $row['id']; ?>"><br>
    <label for="merk">Merk:</label>
    <input type="text" id="merk" name="merk" required value="<?php echo $row['merk']; ?>"><br>

    <label for="type">Type:</label>
    <input type="text" id="type" name="type" required value="<?php echo $row['type']; ?>"><br>

    <label for="prijs">Prijs:</label>
    <input type="number" id="prijs" name="prijs" required value="<?php echo $row['prijs']; ?>"><br>

    <button type="submit" name="btn_wzg">Wijzig</button>
  </form>
  <br><br>
  <a href='index.php'>Home</a>
</body>
</html>

