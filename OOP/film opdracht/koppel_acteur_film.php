<?php
require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/repositories/FilmRepository.php';
require_once __DIR__ . '/repositories/ActeurRepository.php';

$db = (new Database())->getConnection();
$filmRepo = new FilmRepository($db);
$acteurRepo = new ActeurRepository($db);

if ($_POST) {
    $filmRepo->addActorToFilm($_POST['film_id'], $_POST['acteur_id']);
    echo "Acteur gekoppeld! <a href='index.php'>Terug</a>";
    exit;
}

$films = $filmRepo->getAll();
$acteurs = $acteurRepo->getAll();
?>
<form method="post">
    Film:
    <select name="film_id">
        <?php foreach ($films as $film): ?>
            <option value="<?= $film->getId(); ?>"><?= $film->getFilmnaam(); ?></option>
        <?php endforeach; ?>
    </select><br>

    Acteur:
    <select name="acteur_id">
        <?php foreach ($acteurs as $acteur): ?>
            <option value="<?= $acteur->getId(); ?>"><?= $acteur->getActeurnaam(); ?></option>
        <?php endforeach; ?>
    </select><br>

    <button>Koppelen</button>
</form>
