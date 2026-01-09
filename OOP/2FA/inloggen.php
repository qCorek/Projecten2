<?php
session_start();

/* Database verbinding */
$dsn = "mysql:host=localhost;dbname=login2fa;charset=utf8mb4";
$user = "root";
$pass = "";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];

$pdo = new PDO($dsn, $user, $pass, $options);

/* Include Google Authenticator */
require_once __DIR__ . '/PHPGangsta/GoogleAuthenticator.php';

use PHPGangsta\GoogleAuthenticator;
$ga = new GoogleAuthenticator();

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $code = $_POST['code'];

    /* Gebruiker ophalen */
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $userData = $stmt->fetch();

    if ($userData && password_verify($password, $userData['password'])) {

        /* 2FA check */
        $checkResult = $ga->verifyCode(
            $userData['2fa_secret'],
            $code,
            2
        );

        if ($checkResult) {
            $_SESSION['user'] = $username;
            echo "<h2>Login succesvol!</h2>";
            exit;
        } else {
            $error = "Onjuiste 2FA code";
        }

    } else {
        $error = "Gebruikersnaam of wachtwoord fout";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inloggen</title>
</head>
<body>

<h1>Login</h1>

<?php if ($error): ?>
    <p style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>

<form method="post">
    <label>Username</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <label>2FA Code</label><br>
    <input type="text" name="code" required><br><br>

    <button type="submit">Login</button>
</form>

</body>
</html>
