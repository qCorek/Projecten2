<?php
require_once __DIR__ . '/../models/Film.php';
require_once __DIR__ . '/../models/Acteur.php';

class FilmRepository
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM films ORDER BY filmnaam");
        $result = [];
        while ($row = $stmt->fetch()) {
            $result[] = new Film($row['id'], $row['filmnaam'], $row['genre']);
        }
        return $result;
    }

    public function add(Film $film): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO films (filmnaam, genre) VALUES (:filmnaam, :genre)"
        );
        return $stmt->execute([
            ':filmnaam' => $film->getFilmnaam(),
            ':genre'    => $film->getGenre(),
        ]);
    }

    public function addActorToFilm(int $filmId, int $acteurId): bool
    {
        $check = $this->db->prepare(
            "SELECT id FROM film_acteur WHERE film_id = :film AND acteur_id = :acteur"
        );
        $check->execute([':film' => $filmId, ':acteur' => $acteurId]);
        if ($check->fetch()) {
            return true;
        }

        $stmt = $this->db->prepare(
            "INSERT INTO film_acteur (film_id, acteur_id) VALUES (:film, :acteur)"
        );
        return $stmt->execute([
            ':film'   => $filmId,
            ':acteur' => $acteurId,
        ]);
    }

    public function getActorsForFilm(int $filmId): array
    {
        $sql = "SELECT a.* 
                FROM acteurs a
                INNER JOIN film_acteur fa ON fa.acteur_id = a.id
                WHERE fa.film_id = :filmId
                ORDER BY a.acteurnaam";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':filmId' => $filmId]);

        $actors = [];
        while ($row = $stmt->fetch()) {
            $actors[] = new Acteur($row['id'], $row['acteurnaam']);
        }
        return $actors;
    }
}
