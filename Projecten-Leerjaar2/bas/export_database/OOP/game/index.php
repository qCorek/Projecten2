<?php
session_start();
require 'Game.php';
require 'Die.php';
require 'Turn.php';

if (!isset($_SESSION['game'])) {
    $_SESSION['game'] = null;
}

$game = $_SESSION['game'];
$message = "";

// Start nieuwe game
if (isset($_POST['start'])) {
    $amount = max(3, min(8, (int)$_POST['amount']));
    $game = new Game($amount);
    $_SESSION['game'] = $game;
}

// Raden
if (isset($_POST['guess'])) {
    if ($game) {
        $ice = (int)$_POST['ice'];
        $bears = (int)$_POST['bears'];
        $peng = (int)$_POST['penguins'];
        $message = $game->guess(new Turn($ice, $bears, $peng));
    }
}

// Oplossing
if (isset($_POST['solution'])) {
    if ($game) {
        $answer = $game->getAnswer();
        $message = "Oplossing: {$answer['ice']} wakken, {$answer['bears']} ijsberen, {$answer['penguins']} pinguïns.";
        $game->finished = true;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>IJsbear Game</title>
    <style>
        body { font-family: Arial; margin: 30px; }
        .dice { font-size: 30px; padding: 10px; display: inline-block; }
    </style>
</head>
<body>

<h1>Wakken en IJsberen</h1>

<?php if ($message): ?>
<p><strong><?= $message ?></strong></p>
<?php endif; ?>

<h2>Nieuwe worp</h2>
<form method="post">
    Aantal dobbelstenen (3–8):
    <input type="number" name="amount" value="3" min="3" max="8">
    <button name="start">Gooi dobbelstenen</button>
</form>

<?php if ($game): ?>
    <h2>Dobbelstenen</h2>

    <?php foreach ($game->dice as $die): ?>
        <div class="dice">🎲 <?= $die->value ?></div>
    <?php endforeach; ?>

    <?php if (!$game->finished): ?>
        <h2>Jouw raad</h2>
        <form method="post">
            Wakken: <input type="number" name="ice"><br>
            IJsberen: <input type="number" name="bears"><br>
            Pinguïns: <input type="number" name="penguins"><br><br>
            <button name="guess">Raad</button>
            <button name="solution">Toon oplossing</button>
        </form>
    <?php else: ?>
        <p><strong>Game afgerond. Start een nieuwe.</strong></p>
    <?php endif; ?>

<?php endif; ?>

</body>
</html>
