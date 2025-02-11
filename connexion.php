<?php
session_start();


$host = 'localhost';
$dbname = 'connect';
$user = 'root';
$pass = '';
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Erreur CSRF : Requête invalide.");
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = htmlspecialchars(trim($_POST['username']), ENT_QUOTES, 'UTF-8');
        $password = htmlspecialchars(trim($_POST['password']), ENT_QUOTES, 'UTF-8');



        if (empty($username) || empty($password)) {
            die("Erreur : Tous les champs sont obligatoires.");
        }

        $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = :username");
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $username;
            header("Location: bienvenue.php", true, 302);
            exit();
        } else {
            sleep(2);
            die("Erreur : Identifiant ou mot de passe incorrect.");
        }
    }
} catch (PDOException $e) {
    die("Une erreur est survenue.");
}

?>

