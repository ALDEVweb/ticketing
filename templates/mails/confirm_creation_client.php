<?php

// Template pour le mail de confirmation
// Paramètre : néant



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta charset="UTF-8">
</head>
<body>
    <h2>Bonjour <?= $prenom ?> !</h2><br>
    <p>Bienvenu sur l'application ticketing, votre compte a été créé avec succès !</p><br>
    <p>Vous pouvez maintenant vous connecter avec vos identifiants en suivant ce lien : <a href="http://tickets.alaugier.mywebecom.ovh/ticketing/afficher_accueil.php">Connexion</a></p><br>
    <p>Vos identifiants :</p><br>
    <ul>
        <li>Email : <?= $mailTo ?></li>
        <li>Mot de passe : <?= $param["pwd"] ?></li>
    </ul><br>
    <p>Ce mot de passe est généré automatiquement, nous vous invitons à le modifier via les paramètres de l'application.</p>
</body>
</html>