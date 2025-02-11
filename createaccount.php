<?php
session_start();

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}


$host = 'localhost';
$dbname = 'connect';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die("Erreur CSRF : Requête invalide.");
        }

        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        if (empty($username) || empty($password)) {
            die("Erreur : Tous les champs sont obligatoires.");
        }

        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username");
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->fetch()) {
            die("Erreur : Identifiant déjà utilisé.");
        }

        if (strlen($password) < 10) {
            die("Le mot de passe doit contenir au moins 10 caractères.");
        }
        
        // Vérifier si le mot de passe contient des majuscules, des chiffres et des caractères spéciaux
        if (!preg_match('/[A-Z]/', $password)) {
            die("Le mot de passe doit contenir au moins une majuscule.");
        }
        if (!preg_match('/[0-9]/', $password)) {
            die("Le mot de passe doit contenir au moins un chiffre.");
        }
        if (!preg_match('/[\W_]/', $password)) {
            die("Le mot de passe doit contenir au moins un caractère spécial.");
        }
        
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":password", $passwordHash, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "Compte créé avec succès ! <a href='index.php'>Se connecter</a>";
        } else {
            echo "Erreur lors de la création du compte.";
        }
    }
} catch (PDOException $e) {
    die(" Une erreur est survenue.");
}
?>
