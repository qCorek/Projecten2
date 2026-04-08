<?php
// auteur: umit ali akbas
// functie: Verkooporder class

namespace Bas\classes;

use Bas\classes\Database;
use PDO;

class Verkooporder extends Database {

    private $table_name = "verkooporder";

    // =========================
    // READ ALL
    // =========================
    public function getOrders() : array {
        $conn = $this->getConnection();
        $sql = "SELECT * FROM $this->table_name";
        return $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // =========================
    // GET BY ID (nodig voor UPDATE)
    // =========================
    public function getOrderById($id){
        $conn = $this->getConnection();

        $sql = "SELECT * FROM $this->table_name WHERE verkOrdId = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // =========================
    // INSERT
    // =========================
    public function insertOrder($klantId, $artId, $datum, $aantal, $status){

        $conn = $this->getConnection();

        $sql = "INSERT INTO $this->table_name 
                (klantId, artId, verkOrdDatum, verkOrdBestAantal, verkOrdStatus)
                VALUES (:klantId, :artId, :datum, :aantal, :status)";

        $stmt = $conn->prepare($sql);

        return $stmt->execute([
            'klantId' => $klantId,
            'artId' => $artId,
            'datum' => $datum,
            'aantal' => $aantal,
            'status' => $status
        ]);
    }

    // =========================
    // UPDATE
    // =========================
    public function updateOrder($id, $klantId, $artId, $datum, $aantal, $status){

        $conn = $this->getConnection();

        $sql = "UPDATE $this->table_name 
                SET klantId = :klantId,
                    artId = :artId,
                    verkOrdDatum = :datum,
                    verkOrdBestAantal = :aantal,
                    verkOrdStatus = :status
                WHERE verkOrdId = :id";

        $stmt = $conn->prepare($sql);

        return $stmt->execute([
            'id' => $id,
            'klantId' => $klantId,
            'artId' => $artId,
            'datum' => $datum,
            'aantal' => $aantal,
            'status' => $status
        ]);
    }

    // =========================
    // DELETE
    // =========================
    public function deleteOrder($id){

        $conn = $this->getConnection();

        $sql = "DELETE FROM $this->table_name WHERE verkOrdId = :id";
        $stmt = $conn->prepare($sql);

        return $stmt->execute([
            'id' => $id
        ]);
    }

    // =========================
    // TABLE WEERGAVE
    // =========================
    public function showTable($lijst) : void {

        if(empty($lijst)){
            echo "Geen orders gevonden";
            return;
        }

        echo "<table>";

        echo "<tr>
                <th>OrderID</th>
                <th>KlantID</th>
                <th>ArtikelID</th>
                <th>Datum</th>
                <th>Aantal</th>
                <th>Status</th>
                <th>Wijzig</th>
                <th>Verwijder</th>
              </tr>";

        foreach($lijst as $row){
            echo "<tr>
                    <td>{$row['verkOrdId']}</td>
                    <td>{$row['klantId']}</td>
                    <td>{$row['artId']}</td>
                    <td>{$row['verkOrdDatum']}</td>
                    <td>{$row['verkOrdBestAantal']}</td>
                    <td>{$row['verkOrdStatus']}</td>

                    <td>
<a href='../verkooporder/update_order.php?id={$row['verkOrdId']}'>Wijzig</a>
                    </td>

                    <td>
<a href='../verkooporder/delete_order.php?id={$row['verkOrdId']}'>Verwijder</a>   
                 </td>
                  </tr>";
        }

        echo "</table>";
    }
}
?>