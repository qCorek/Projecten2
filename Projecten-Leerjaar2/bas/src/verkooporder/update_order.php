<?php
require '../../vendor/autoload.php';

use Bas\classes\Verkooporder;

$order = new Verkooporder();
$id = $_GET['id'];

if(isset($_POST['update'])){

    $order->updateOrder(
        $id,
        $_POST['klantId'],
        $_POST['artId'],
        $_POST['datum'],
        $_POST['aantal'],
        $_POST['status']
    );

    echo '<script>alert("Order bijgewerkt")</script>';
echo "<script> location.replace('../klant/read.php?msg=updated'); </script>";

}

$data = $order->getOrderById($id);
?>

<form method="post">

KlantID: <input type="number" name="klantId" value="<?= $data['klantId'] ?>"><br>
ArtikelID: <input type="number" name="artId" value="<?= $data['artId'] ?>"><br>
Datum: <input type="date" name="datum" value="<?= $data['verkOrdDatum'] ?>"><br>
Aantal: <input type="number" name="aantal" value="<?= $data['verkOrdBestAantal'] ?>"><br>
Status: <input type="number" name="status" value="<?= $data['verkOrdStatus'] ?>"><br><br>

<input type="submit" name="update" value="Opslaan">

</form>