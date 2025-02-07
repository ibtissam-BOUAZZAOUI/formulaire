<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: index.html");
    exit();
}
echo "Bienvenue, " . htmlspecialchars($_SESSION["username"], ENT_QUOTES, 'UTF-8');

echo "<br><a href='déconnexion.php'>Se déconnecter</a>";
?>
