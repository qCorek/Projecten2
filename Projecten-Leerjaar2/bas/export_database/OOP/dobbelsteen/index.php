<?php
// index.php - startpunt van de applicatie
session_start();
require_once 'Game.php';

// Nieuw spel starten
if (isset($_POST['reset'])) {
    unset($_SESSION['game']);
}

// Bestaat er al een spel in de sessie?
if (!isset($_SESSION['game'])) {
    $_SESSION['game'] = new Game();
}

$game = $_SESSION['game'];

// Als op 'Gooi dobbelstenen' is geklikt
if (isset($_POST['throw'])) {
    $game->throwAllDice();
    $_SESSION['game'] = $game;
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Eenvoudig Dobbelspel</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .dice-row { display: flex; margin-top: 10px; }
        .message { margin-top: 10px; font-weight: bold; }
    </style>
</head>
<body>

<h1>Eenvoudig dobbelspel met 5 dobbelstenen</h1>

<p>Je mag in totaal <?php echo Game::MAX_THROWS; ?> keer gooien.</p>

<form method="post">
    <button type="submit" name="throw" <?php echo !$game->canThrow() ? 'disabled' : ''; ?>>
        Gooi dobbelstenen
    </button>
    <button type="submit" name="reset">Nieuw spel</button>
</form>

<p>Aantal worpen tot nu toe: <?php echo $game->getThrowCount(); ?></p>

<?php
$lastThrow = $game->getLastThrow();
if (!empty($lastThrow)) {
    // EXTRA: als alle dobbelstenen gelijk zijn, kleur ze lichtgroen
    $allEqual = $game->allDiceEqual();
    $color = $allEqual ? '#c8e6c9' : 'white';

    echo "<div class='dice-row'>";
    foreach ($lastThrow as $value) {
        echo $game->generateSvgForValue($value, $color);
    }
    echo "</div>";

    echo "<p>Laatste worp: ";
    echo implode(', ', $lastThrow);
    echo "</p>";

    if ($allEqual) {
        echo "<p class='message'>EXTRA: Alle dobbelstenen hebben hetzelfde aantal ogen! Goed gedaan!</p>";
    }
}

if ($game->isFinished()) {
    echo "<p class='message'>Het spel is afgelopen. Start een nieuw spel om opnieuw te spelen.</p>";
}
?>

</body>
</html>
