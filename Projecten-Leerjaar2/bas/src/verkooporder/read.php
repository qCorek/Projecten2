<?php
session_start();

if (!isset($_SESSION['role'])) {
    header('Location: ../login.php');
    exit;
}

require '../../vendor/autoload.php';

use Bas\classes\Verkooporder;

$order = new Verkooporder();
$melding = "";

// =========================
// MELDING NA ACTIES
// =========================
if (isset($_GET['msg'])) {
    if ($_GET['msg'] == 'updated') {
        $melding = "Order bijgewerkt!";
    }
    if ($_GET['msg'] == 'deleted') {
        $melding = "Order verwijderd!";
    }
    if ($_GET['msg'] == 'inserted') {
        $melding = "Order succesvol toegevoegd!";
    }
}

// =========================
// NIEUWE ORDER (ALLEEN MAGAZIJN)
// =========================
if (isset($_POST["insert_order"]) && $_SESSION['role'] === 'magazijn') {

    $order->insertOrder(
        $_POST["klantId"],
        $_POST["artId"],
        $_POST["datum"],
        $_POST["aantal"],
        $_POST["status"]
    );

    header("Location: read.php?msg=inserted");
    exit;
}

// =========================
// DATA OPHALEN
// =========================
$orders = $order->getOrders();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>CRUD Verkooporder</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<h1>CRUD Verkooporder</h1>

<nav>
    <a href="../index.php">Home</a><br>
</nav>

<?php
if ($melding != "") {
    echo "<p style='color:green;'>$melding</p>";
}
?>

<!-- ========================= -->
<!-- NIEUWE ORDER (MAGAZIJN) -->
<!-- ========================= -->
<?php if ($_SESSION['role'] === 'magazijn'): ?>

<h2>Nieuwe Verkooporder</h2>

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
<select name="status" required>
    <option value="Nieuw">Nieuw</option>
    <option value="Verwerkt">Verwerkt</option>
    <option value="Onderweg">Onderweg</option>
    <option value="Bezorgd">Bezorgd</option>
</select><br><br>

<input type="submit" name="insert_order" value="Toevoegen order">

</form>

<br>

<?php endif; ?>

<!-- ========================= -->
<!-- ORDER LIJST -->
<!-- ========================= -->

<h2>Overzicht Verkooporders</h2>

<?php
$order->showTable($orders);
?>

</body>
</html>