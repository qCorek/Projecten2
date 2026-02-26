<?php
class User {
    private $conn;

    private function dbConnect() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "login_db";

        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Database connectie mislukt: " . $e->getMessage();
        }
    }

    public function registerUser($username, $email, $password) {
        $this->dbConnect();

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);

        try {
            $stmt->execute();
            echo "✅ Gebruiker succesvol geregistreerd!";
        } catch (PDOException $e) {
            echo "❌ Registratie mislukt: " . $e->getMessage();
        }
    }

    public function loginUser($username, $password) {
        $this->dbConnect();

        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            echo "✅ Inloggen geslaagd! Welkom, " . htmlspecialchars($user['username']) . "!";
        } else {
            echo "❌ Foute gebruikersnaam of wachtwoord.";
        }
    }
}
?>