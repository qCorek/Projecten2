<?php
// ====== Eenvoudige database-verbinding met PDO ======
$host = 'localhost';
$db   = 'film';
$user = 'root';
$pass = ''; // zet hier je wachtwoord als je die hebt

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die("Database-fout: " . $e->getMessage());
}

// ====== Form verwerken: film toevoegen ======
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filmnaam = trim($_POST['filmnaam'] ?? '');
    $genre    = trim($_POST['genre'] ?? '');

    if ($filmnaam === '') {
        $errors[] = "Filmnaam is verplicht.";
    }
    if ($genre === '') {
        $errors[] = "Genre is verplicht.";
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO films (filmnaam, genre) VALUES (:filmnaam, :genre)");
        $stmt->execute([
            ':filmnaam' => $filmnaam,
            ':genre'    => $genre,
        ]);
        // veld leegmaken na opslaan
        $filmnaam = '';
        $genre    = '';
    }
}

// ====== Films ophalen ======
$stmt = $pdo->query("SELECT * FROM films ORDER BY filmnaam");
$films = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Eenvoudige film-website</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 30px auto;
        }
        h1, h2 {
            color: #333;
        }
        form {
            padding: 10px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-top: 8px;
        }
        input[type="text"] {
            width: 100%;
            padding: 6px;
            box-sizing: border-box;
        }
        button {
            margin-top: 10px;
            padding: 6px 12px;
            cursor: pointer;
        }
        .errors {
            color: red;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 6px;
        }
        th {
            background: #f2f2f2;
        }
    </style>
</head>
<body>

<h1>Filmregistratie (simpel)</h1>

<h2>Nieuwe film toevoegen</h2>

<?php if (!empty($errors)): ?>
    <div class="errors">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post">
    <label>
        Filmnaam:
        <input type="text" name="filmnaam" value="<?= htmlspecialchars($filmnaam ?? '') ?>">
    </label>

    <label>
        Genre:
        <input type="text" name="genre" value="<?= htmlspecialchars($genre ?? '') ?>">
    </label>

    <button type="submit">Opslaan</button>
</form>

<h2>Overzicht van films</h2>

<?php if (empty($films)): ?>
    <p>Er zijn nog geen films opgeslagen.</p>
<?php else: ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Filmnaam</th>
            <th>Genre</th>
        </tr>
        <?php foreach ($films as $film): ?>
            <tr>
                <td><?= $film['id']; ?></td>
                <td><?= htmlspecialchars($film['filmnaam']); ?></td>
                <td><?= htmlspecialchars($film['genre']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

</body>
</html>
