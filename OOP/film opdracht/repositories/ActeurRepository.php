<?php
require_once __DIR__ . '/../models/Acteur.php';

class ActeurRepository
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM acteurs ORDER BY acteurnaam");
        $actors = [];
        while ($row = $stmt->fetch()) {
            $actors[] = new Acteur($row['id'], $row['acteurnaam']);
        }
        return $actors;
    }

    public function add(Acteur $acteur): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO acteurs (acteurnaam) VALUES (:naam)"
        );
        return $stmt->execute([':naam' => $acteur->getActeurnaam()]);
    }
}
