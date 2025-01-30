<?php
$host = 'localhost'; 
$user = 'root';      
$pass = '';           
$dbName = 'connect';  

try {
 
    $pdo = new PDO("mysql:host=$host", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    $sql = file_get_contents('database.sql');

    $pdo->exec($sql);

    echo "Base de données et tables créées avec succès !";
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>
