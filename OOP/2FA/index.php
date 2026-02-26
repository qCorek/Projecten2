<?php
session_start();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Login met 2FA</title>
</head>
<body>

<h1>Login met Google Authenticator (2FA)</h1>

<?php if (isset($_SESSION['user'])): ?>
    <p>Welkom, <strong><?php echo $_SESSION['user']; ?></strong></p>
    <p>Je bent ingelogd.</p>
<?php else: ?>
    <p>Kies een optie:</p>
    <ul>
        <li><a href="registreren.php">Registreren</a></li>
        <li><a href="inloggen.php">Inloggen</a></li>
    </ul>
<?php endif; ?>

</body>
</html>
