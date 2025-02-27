<?php 
session_start(); 

// Vérifier si le token CSRF existe dans la session, sinon le créer
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        body { font-family: Arial, sans-serif; display: flex; flex-direction: column; align-items: center; }
        form { display: flex; flex-direction: column; width: 300px; }
        input, button { margin: 5px 0; padding: 10px; }
        #newcompte { margin-top: 10px; font-weight: bold; color: red; }
    </style>
</head>
<body>
    <img src="p_8.png" alt="Logo" width="100">
    <h2>Connexion</h2>
    
    <form action="connexion.php" method="POST">
        <input type="text" name="username" placeholder="Identifiant" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

        <button type="reset">Reset</button>
        <button type="submit">Connexion</button>
    </form>

    <p id="newcompte"></p>
    <p>Pas encore de compte ? <a href="newaccount.php">Créer un compte</a></p>
</body>
</html>
