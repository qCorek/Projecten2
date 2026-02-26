<?php
session_start();

/* Database verbinding */
$dsn = "mysql:host=localhost;dbname=login2fa;charset=utf8mb4";
$dbUser = "root";
$dbPass = "";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];

$pdo = new PDO($dsn, $dbUser, $dbPass, $options);

/* Google Authenticator includen */
require_once __DIR__ . '/PHPGangsta/GoogleAuthenticator.php';

use PHPGangsta\GoogleAuthenticator;

$ga = new GoogleAuthenticator();

$qrCodeUrl = null;
$secret = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    /* Secret aanmaken */
    $secret = $ga->createSecret();

    /* Gebruiker opslaan */
    $stmt = $pdo->prepare(
        "INSERT INTO users (username, password, 2fa_secret)
         VALUES (?, ?, ?)"
    );
    $stmt->execute([$username, $password, $secret]);

    /* QR-code genereren */
    $qrCodeUrl = $ga->getQRCodeGoogleUrl('TCRHELDEN', $secret);
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Registreren</title>
</head>
<body>

<h1>Register</h1>

<form method="post">
    <label>Username</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Registreren</button>
</form>

<?php if ($qrCodeUrl): ?>
    <h3>Registratie succesvol! Scan deze QR code met Google Authenticator:</h3>

    <img src="<?php echo htmlspecialchars($qrCodeUrl); ?>" alt="QR Code"><br><br>

    <p><strong>Sla de geheime sleutel op:</strong> <?php echo htmlspecialchars($secret); ?></p>
<?php endif; ?>

<br>
<a href="inloggen.php">Login</a>

</body>
</html>
