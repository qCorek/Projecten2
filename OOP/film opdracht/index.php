<?php
$host = 'localhost';
$db   = 'film';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

$pdo = new PDO($dsn, $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filmnaam = trim($_POST['filmnaam'] ?? '');
    $genre    = trim($_POST['genre'] ?? '');

    if ($filmnaam === '') $errors[] = "Filmnaam is verplicht.";
    if ($genre === '')    $errors[] = "Genre is verplicht.";

    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO films (filmnaam, genre) VALUES (:filmnaam, :genre)");
        $stmt->execute([':filmnaam' => $filmnaam, ':genre' => $genre]);
        $filmnaam = '';
        $genre = '';
    }
}

$stmt = $pdo->query("SELECT * FROM films ORDER BY filmnaam");
$films = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Eenvoudige film-website</title>
    <style>
        body { font-family: Arial; max-width:800px; margin:30px auto; }
        form { border:1px solid #ccc; padding:10px; margin-bottom:20px; }
        input[type="text"] { width:100%; padding:5px; }
        label { display:block; margin-top:8px; }
        table { width:100%; border-collapse:collapse; margin-top:10px; }
        th, td { border:1px solid #ccc; padding:6px; }
        th { background:#eee; }
        button { margin-top:10px; padding:6px 12px; }
        .errors { color:red; }
    </style>
</head>
<body>

<h1>Filmregistratie</h1>
<h2>Film toevoegen</h2>

<?php if (!empty($errors)): ?>
<div class="errors">
    <ul>
        <?php foreach ($errors as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<form method="post">
    <label>Filmnaam:
        <input type="text" name="filmnaam" value="<?= htmlspecialchars($filmnaam ?? '') ?>">
    </label>
    <label>Genre:
        <input type="text" name="genre" value="<?= htmlspecialchars($genre ?? '') ?>">
    </label>
    <button type="submit">Opslaan</button>
</form>

<h2>Films</h2>

<?php if (empty($films)): ?>
<p>Geen films gevonden.</p>
<?php else: ?>
<table>
    <tr>
        <th>ID</th>
        <th>Filmnaam</th>
        <th>Genre</th>
    </tr>
    <?php foreach ($films as $f): ?>
    <tr>
        <td><?= $f['id'] ?></td>
        <td><?= htmlspecialchars($f['filmnaam']) ?></td>
        <td><?= htmlspecialchars($f['genre']) ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>

</body>
</html>
