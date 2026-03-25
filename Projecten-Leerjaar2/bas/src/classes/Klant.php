<?php
namespace Bas\classes;

use Bas\classes\Database;
use Bas\classes\TableHelper;

class Klant extends Database {

    private $table_name = "klant";

    // =========================
    // READ ALL
    // =========================
    public function getKlanten() : array {
        $conn = $this->getConnection();
        $sql = "SELECT * FROM $this->table_name";
        return $conn->query($sql)->fetchAll();
    }

    // =========================
    // READ ONE
    // =========================
    public function getKlant(int $klantId) : array {
        $conn = $this->getConnection();

        $sql = "SELECT * FROM $this->table_name WHERE klantId = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $klantId]);

        return $stmt->fetch();
    }

    // =========================
    // ZOEKEN (User story 3)
    // =========================
    public function zoekKlant($naam) : array {
        $conn = $this->getConnection();

        $sql = "SELECT * FROM $this->table_name 
                WHERE klantNaam LIKE :naam";

        $stmt = $conn->prepare($sql);
        $stmt->execute(['naam' => "%$naam%"]);

        return $stmt->fetchAll();
    }

    // =========================
    // INSERT
    // =========================
    public function insertKlant($naam, $email, $adres, $postcode, $woonplaats){

        $conn = $this->getConnection();

        $sql = "INSERT INTO $this->table_name 
                (klantNaam, klantEmail, klantAdres, klantPostcode, klantWoonplaats)
                VALUES (:naam, :email, :adres, :postcode, :woonplaats)";

        $stmt = $conn->prepare($sql);

        return $stmt->execute([
            'naam' => $naam,
            'email' => $email,
            'adres' => $adres,
            'postcode' => $postcode,
            'woonplaats' => $woonplaats
        ]);
    }

    // =========================
    // UPDATE (User story 4)
    // =========================
    public function updateKlant($row) : bool {
        $conn = $this->getConnection();

        $sql = "UPDATE $this->table_name 
                SET klantNaam = :naam,
                    klantEmail = :email,
                    klantAdres = :adres,
                    klantPostcode = :postcode,
                    klantWoonplaats = :woonplaats
                WHERE klantId = :id";

        $stmt = $conn->prepare($sql);

        return $stmt->execute([
            'naam' => $row['klantnaam'],
            'email' => $row['klantemail'],
            'adres' => $row['klantadres'],
            'postcode' => $row['klantpostcode'],
            'woonplaats' => $row['klantwoonplaats'],
            'id' => $row['klantId']
        ]);
    }

    // =========================
    // DELETE (User story 5)
    // =========================
public function deleteKlant(int $klantId) : bool {
    $conn = $this->getConnection();

    try {
        $sql = "DELETE FROM $this->table_name WHERE klantId = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $klantId]);

        // 🔥 check of er echt iets verwijderd is
        return $stmt->rowCount() > 0;

    } catch (\PDOException $e) {
        return false;
    }
}

    // =========================
    // TABLE WEERGAVE
    // =========================
    public function showTable($lijst) : void {

        if(empty($lijst)){
            echo "Geen resultaten gevonden";
            return;
        }

        $txt = "<table>";
        $txt .= TableHelper::getTableHeader($lijst[0]);

        foreach($lijst as $row){
            $txt .= "<tr>";
            $txt .= "<td>{$row['klantNaam']}</td>";
            $txt .= "<td>{$row['klantEmail']}</td>";
            $txt .= "<td>{$row['klantAdres']}</td>";
            $txt .= "<td>{$row['klantPostcode']}</td>";
            $txt .= "<td>{$row['klantWoonplaats']}</td>";

            // UPDATE
            $txt .= "<td>
                <form method='post' action='update.php?klantId={$row['klantId']}'>
                    <button name='update'>Wijzig</button>
                </form>
            </td>";

            // DELETE
            $txt .= "<td>
                <form method='post' action='delete.php?klantId={$row['klantId']}'>
                    <button name='verwijderen'>Verwijderen</button>
                </form>
            </td>";

            $txt .= "</tr>";
        }

        $txt .= "</table>";
        echo $txt;
    }
}
?>