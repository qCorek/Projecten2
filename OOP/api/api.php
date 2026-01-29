<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
require __DIR__ . '/db.php';

$method = $_SERVER['REQUEST_METHOD'];
$id = $_GET['id'] ?? null;

switch ($method) {

    case 'GET':
        if ($id) {
            $stmt = $pdo->prepare("SELECT * FROM producten WHERE id = ?");
            $stmt->execute([$id]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$product) {
                http_response_code(404);
                echo json_encode(['error' => 'Product niet gevonden']);
                exit;
            }

            http_response_code(200);
            echo json_encode($product);
        } else {
            $stmt = $pdo->query("SELECT * FROM producten ORDER BY created_at DESC");
            http_response_code(200);
            echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['naam']) || !isset($data['prijs'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Naam en prijs zijn verplicht']);
            exit;
        }

        try {
            $stmt = $pdo->prepare(
                "INSERT INTO producten (naam, prijs) VALUES (:naam, :prijs)"
            );
            $stmt->execute([
                ':naam'  => $data['naam'],
                ':prijs' => $data['prijs']
            ]);

            http_response_code(201);
            echo json_encode(['message' => 'Product toegevoegd']);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                http_response_code(400);
                echo json_encode(['error' => 'Productnaam bestaat al']);
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'Serverfout']);
            }
        }
        break;

    case 'PUT':
        if (!$id) {
            http_response_code(400);
            echo json_encode(['error' => 'ID ontbreekt']);
            exit;
        }

        $data = json_decode(file_get_contents('php://input'), true);

        $stmt = $pdo->prepare(
            "UPDATE producten SET naam = :naam, prijs = :prijs WHERE id = :id"
        );
        $stmt->execute([
            ':naam'  => $data['naam'],
            ':prijs' => $data['prijs'],
            ':id'    => $id
        ]);

        if ($stmt->rowCount() === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Product niet gevonden']);
            exit;
        }

        http_response_code(200);
        echo json_encode(['message' => 'Product bijgewerkt']);
        break;

    case 'DELETE':
        if (!$id) {
            http_response_code(400);
            echo json_encode(['error' => 'ID ontbreekt']);
            exit;
        }

        $stmt = $pdo->prepare("DELETE FROM producten WHERE id = ?");
        $stmt->execute([$id]);

        if ($stmt->rowCount() === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Product niet gevonden']);
            exit;
        }

        http_response_code(204);
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Methode niet toegestaan']);
}
