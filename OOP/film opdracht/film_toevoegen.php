<?php
require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/repositories/FilmRepository.php';
require_once __DIR__ . '/models/Film.php';

$db = (new Database())->getConnection();
$repo = new FilmRepository($db);

if ($_POST) {
    $film = new Film(null, $_POST['filmnaam'], $_POST['genre']);
    $repo->add($film);
    echo "Film toegevoegd! <a href='index.php'>Terug</a>";
    exit;
}
?>
<form method="post">
    Filmnaam: <input name="filmnaam"><br>
    Genre: <input name="genre"><br>
    <button>Opslaan</button>
</form>
