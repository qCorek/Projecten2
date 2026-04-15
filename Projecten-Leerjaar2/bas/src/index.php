<?php
session_start();
?>
<!--
	Auteur: Umit Ali Akbas
	Function: home page BAS met dynamisch menu
-->
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bas Boodschappenservice</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Menu BAS</h1>

    <nav>
        <?php if (!isset($_SESSION['role'])): ?>
            <a href="login.php">Login</a>
        <?php else: ?>

            <?php if ($_SESSION['role'] === 'magazijn'): ?>
                <a href="klant/read.php">Klanten beheren</a><br>
                <a href="verkooporder/read.php">Orders beheren</a><br>
            <?php endif; ?>

            <?php if ($_SESSION['role'] === 'bezorger'): ?>
                <a href="verkooporder/read.php">Bekijk / update orders</a><br>
            <?php endif; ?>

            <a href="logout.php">Logout</a>
        <?php endif; ?>
    </nav>
    
</body>
</html>