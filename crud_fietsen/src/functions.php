<?php
// auteur: Vul hier je naam in
// functie: algemene functies tbv hergebruik

include_once "config.php";
require_once 'db.php';

class Crud
{
    public function crudMain()
    {
        // Menu-item   insert
        $txt = "
        <h1>Crud Fietsen</h1>
        <nav>
            <a href='insert.php'>Toevoegen nieuwe fiets</a>
        </nav><br>";
        echo $txt;

        // Haal alle fietsen record uit de tabel 
        $result = $this->getData(CRUD_TABLE);

        // print table
        $this->printCrudTabel($result);
    }

    public function getData($table): array
    {
        $db = new Database();
        $conn = $db->connectDb();

        $sql = "SELECT * FROM $table";
        $query = $conn->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    // selecteer de rij van de opgegeven id
    public function getRecord($id)
    {
        $db = new Database();
        $conn = $db->connectDb();

        $sql = "SELECT * FROM " . CRUD_TABLE . " WHERE id = :id";
        $query = $conn->prepare($sql);
        $query->execute([':id' => $id]);

        return $query->fetch();
    }

    // Print HTML tabel
    public function printCrudTabel($result)
    {
        $table = "<table>";

        $headers = array_keys($result[0]);
        $table .= "<tr>";
        foreach ($headers as $header) {
            $table .= "<th>$header</th>";
        }
        $table .= "<th colspan=2>Actie</th></tr>";

        foreach ($result as $row) {
            $table .= "<tr>";
            foreach ($row as $cell) {
                $table .= "<td>$cell</td>";
            }

            $table .= "<td>
                <form method='post' action='update.php?id=$row[id]'>
                    <button>Wzg</button>
                </form>
            </td>";

            $table .= "<td>
                <form method='post' action='delete.php?id=$row[id]'>
                    <button>Verwijder</button>
                </form>
            </td>";

            $table .= "</tr>";
        }

        $table .= "</table>";
        echo $table;
    }

    public function updateRecord(array $row)
    {
        $db = new Database();
        $conn = $db->connectDb();

        $sql = "UPDATE " . CRUD_TABLE . "
        SET merk = :merk, type = :type, prijs = :prijs
        WHERE id = :id";

        $values = [
            ':merk' => $row['merk'],
            ':type' => $row['type'],
            ':prijs' => $row['prijs'],
            ':id' => $row['id']
        ];

        $stmt = $conn->prepare($sql);
        $stmt->execute($values);

        return ($stmt->rowCount() == 1);
    }

    public function insertRecord($post): bool
    {
        $db = new Database();
        $conn = $db->connectDb();

        $sql = "
            INSERT INTO " . CRUD_TABLE . " (merk, type, prijs)
            VALUES (:merk, :type, :prijs)";

        $values = [
            ':merk' => $post['merk'],
            ':type' => $post['type'],
            ':prijs' => $post['prijs']
        ];

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute($values);
            return ($stmt->rowCount() == 1);
        } catch (PDOException $e) {
            $this->sql_error($e, $sql, $values);
            return false;
        }
    }

    public function deleteRecord($id)
    {
        $db = new Database();
        $conn = $db->connectDb();

        $sql = "DELETE FROM " . CRUD_TABLE . " WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $id]);

        return ($stmt->rowCount() == 1);
    }

    public function sql_error(PDOException $e, string $sql, array $values): void
    {
        echo "
        <h2>Foutmelding</h2>
        Fout op bestand: {$e->getFile()} op regel {$e->getLine()}<br>
        SQL-fout: {$e->getMessage()}<br>
        Foute SQL: $sql<br>
        Opgegeven waarden: " . print_r($values, true);
    }
}
