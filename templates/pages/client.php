<?php
// template : affiche le formulaire de création d'un client avec champ nom, prénom, mail mdp et btns vamlider/annuler
// parametre : $error : 1 si 1 champ n'est pas renseigné
//             $nomClient = 1 si vide ou $nom
//             $prenomClient = 1 si vide ou $prenom
//             $mailClient= 1 si vide ou $mail
//             $mdpClient= 1 si vide ou $mdp
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include "templates/fragments/header.php"; ?>
    <main class="w300 mrlauto blue">
        <h2 class="fs20 mt40">Création client</h2>
        <form class="encart mt40" action="creer_client.php" method="POST">
            <div class="w200 mrlauto">
                <label class='w100p block fs16' for='nomClient'>Nom :</label>
                <input class="w100p mt4" type='text' name='nomClient' id='nomClient' value='<?= nl2br(htmlentities($nomClient)) ?>'>
                <?php
                    if($error == 1 && $nomClient == ""){
                        echo "<p class='w200 mt4 fs12 red mrlauto'>Veuillez saisir un nom</p>";
                    }
                ?>
            </div>
            <div class="w200 mrlauto mt16">
                <label class='w100p block fs16' for='prenomClien'>Prenom :</label>
                <input class="w100p mt4" type='text' name='prenomClient' id='prenomClient' value='<?= nl2br(htmlentities($prenomClient)) ?>'>
                <?php
                    if($error == 1 && $prenomClient == ""){
                        echo "<p class='w200 mt4 fs12 red mrlauto'>Veuillez saisir un prenom</p>";
                    }
                ?>
            </div>
            <div class="w200 mrlauto mt16">
                <label class='w100p block fs16' for='mailClient'>Mail :</label>
                <input class="w100p mt4" type='email' name='mailClient' id='mailClient' value='<?= nl2br(htmlentities($mailClient)) ?>'>
                <?php
                    if($error == 1 && $mailClient == ""){
                        echo "<p class='w200 mt4 fs12 red mrlauto'>Veuillez saisir un mail</p>";
                    }
                ?>
            </div>
            <div class="w200 mrlauto mt16 flex j-between a-center">
                <input class="fs14" type="submit" value="Créer">
                <a class="fs12" href="afficher_accueil.php">Annuler</a>
            </div>
        </form>
    </main>
    <script src="js/client.js" defer></script>
</body>
</html>