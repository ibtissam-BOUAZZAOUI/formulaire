# formulaire
 formulaire sécurisé
 ## Technologies utilisées  
- **Langage** : PHP 8, HTML, CSS
- **Base de données** : MySQL  
- **Serveur web** : Apache (via WAMP)

# utilisation
lancer crate_db.php pour créer la base de données, ensuite ouvrez formulaire.html où vous trouverez un lien pour créer un compte. une fois inscrit, une page sera affichée pour vous rediriger vers la connexion

# create_db.php
pour crée la base de données nommée connect et une table users avec 3  attribut id, username, password

# index.html
page de connexion avec une formulaire comportant :
log de p8, deux champs (identifiant et mot de passe), 2 button (reset et connexion) et un lien href pour crée un nouveau compte (se redirige vers newaccount.html)

# connexion.php
pour vérifier la connexion: comparant les informations saisies avec celles enregistrées dans la bdd

# bienvenue.php
affiche connexion réussie, avec un button pour se déconnecter

# newaccount.html
formulaire pour créer un nouveau compte

# createaccount.php
enregistrer un nouveau compte dans la bdd





