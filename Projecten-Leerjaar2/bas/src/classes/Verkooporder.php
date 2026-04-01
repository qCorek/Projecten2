<?php
// auteur: umit ali akbas
// functie: Verkooporder class


namespace Bas\classes;

use Bas\classes\Database;

class Verkooporder extends Database {

    private $table_name = "verkooporder";

    // =========================
    // READ ALL
    // =========================
    public function getOrders() : array {
        $conn = $this->getConnection();
        $sql = "SELECT * FROM $this->table_name";
        return $conn->query($sql)->fetchAll();
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
              </tr>";

        foreach($lijst as $row){
            echo "<tr>
                    <td>{$row['verkOrdId']}</td>
                    <td>{$row['klantId']}</td>
                    <td>{$row['artId']}</td>
                    <td>{$row['verkOrdDatum']}</td>
                    <td>{$row['verkOrdBestAantal']}</td>
                    <td>{$row['verkOrdStatus']}</td>
                  </tr>";
        }

        echo "</table>";
    }
}
?>