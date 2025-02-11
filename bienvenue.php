<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php", true, 302);
    exit();
}
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

echo "Bienvenue, " . htmlspecialchars($_SESSION["username"], ENT_QUOTES, 'UTF-8');

echo "<br><a href='déconnexion.php'>Se déconnecter</a>";
?>
