<?php
require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/repositories/ActeurRepository.php';
require_once __DIR__ . '/models/Acteur.php';

$db = (new Database())->getConnection();
$repo = new ActeurRepository($db);

if ($_POST) {
    $acteur = new Acteur(null, $_POST['acteurnaam']);
    $repo->add($acteur);
    echo "Acteur toegevoegd! <a href='index.php'>Terug</a>";
    exit;
}
?>
<form method="post">
    Acteurnaam: <input name="acteurnaam"><br>
    <button>Opslaan</button>
</form>
