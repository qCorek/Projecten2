<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';

    if ($username === 'magazijn') {
        $_SESSION['role'] = 'magazijn';
        header('Location: index.php');
        exit;
    } elseif ($username === 'bezorger') {
        $_SESSION['role'] = 'bezorger';
        header('Location: index.php');
        exit;
    } else {
        $fout = "Onbekende gebruiker";
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    <?php if (!empty($fout)) echo "<p style='color:red;'>$fout</p>"; ?>

    <form method="post">
        <label>Gebruikersnaam:</label>
        <input type="text" name="username" required>
        <br><br>
        <input type="submit" value="Inloggen">
    </form>

    <p>Gebruik als naam: <strong>magazijn</strong> of <strong>bezorger</strong></p>
</body>
</html>