<?php
require '../../vendor/autoload.php';

use Bas\classes\Verkooporder;

$order = new Verkooporder();
$id = $_GET['id'];

if(isset($_POST['verwijderen'])){

    $order->deleteOrder($id);

    echo '<script>alert("Order verwijderd")</script>';
echo "<script> location.replace('../klant/read.php?msg=deleted'); </script>";

}
?>

<h2>Weet je zeker dat je deze order wilt verwijderen?</h2>

<form method="post">
    <input type="submit" name="verwijderen" value="Ja, verwijderen">
</form>