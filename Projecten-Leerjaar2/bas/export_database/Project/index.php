<?php
// Functie: programma login OOP 
// Auteur: Studentnaam

session_start(); // 👈 Belangrijk: altijd bovenaan, vóór HTML

require_once 'classes/User.php';
$user = new User();

// Indien Logout geklikt
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    $user->Logout();
}

// Controleer of gebruiker is ingelogd
if (!$user->isLoggedin()) {
    echo "<h3>PDO Login and Registration</h3><hr/>";
    echo "U bent niet ingelogd. Log in om verder te gaan.<br><br>";
    echo '<a href="login_form.php">Login</a>';
    exit();
}

// ✅ Haal gebruikersnaam op uit sessie
$username = $_SESSION['username'];

// ✅ Haal gegevens op uit database
$user->getUser($username);
?>

<!DOCTYPE html>
<html lang="nl">
<body>

    <h3>PDO Login and Registration</h3>
    <hr/>

    <h3>Welcome op de HOME-pagina!</h3>
    <br/>

    <h2>Het spel kan beginnen</h2>
    <p>Je bent ingelogd met:</p>
    <strong>Gebruikersnaam: <?php echo htmlspecialchars($username); ?></strong>

    <br><br>
    <a href="?logout=true">Logout</a>

</body>
</html>
