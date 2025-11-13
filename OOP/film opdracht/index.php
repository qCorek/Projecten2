<?php
require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/repositories/FilmRepository.php';
require_once __DIR__ . '/repositories/ActeurRepository.php';

$db = (new Database())->getConnection();
$filmRepo = new FilmRepository($db);
$acteurRepo = new ActeurRepository($db);

$films = $filmRepo->getAll();
?>
<!DOCTYPE html>
<html>
<head><title>Filmregistratie</title></head>
<body>
<h1>Filmregistratie</h1>

<p>
    <a href="film_toevoegen.php">Film toevoegen</a> |
    <a href="acteur_toevoegen.php">Acteur toevoegen</a> |
    <a href="koppel_acteur_film.php">Acteur koppelen</a>
</p>

<h2>Overzicht</h2>

<?php foreach ($films as $film): ?>
    <h3><?= $film->getFilmnaam(); ?> (<?= $film->getGenre(); ?>)</h3>
    <ul>
        <?php foreach ($filmRepo->getActorsForFilm($film->getId()) as $acteur): ?>
            <li><?= $acteur->getActeurnaam(); ?></li>
        <?php endforeach; ?>
    </ul>
<?php endforeach; ?>
</body>
</html>
