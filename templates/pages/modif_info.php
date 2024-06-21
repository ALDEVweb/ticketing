<?php
// template : affiche le formulaire de modification des infos : mdp (ancien pour vérif bonne personne, nouveau et confirm + mail si user = client)
// parametre : $id_user : id de l'utilisateur connecté 
//             $mail : mail de l'utilisateur(si id est un client)
//             $error : si erreur de saisie
//                                 $mail(si  renseigné)
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
    <?php include "templates/fragments/header.php" ?>
    <main class="w300 mrlauto blue">
        <h2 class="fs20 mt40">Modification de mes information</h2>
        <form class="encart mt40" action="enregistrer_modif.php" method="POST">
            <?php
            if($espace === "client"){
                ?>
                <div class="w200 mrlauto">
                    <label class='w100p block fs16' for='mail'>Mail :</label>
                    <input class="w100p mt4" type='email' name='mail' id='mail' value='<?= htmlentities($mail) ?>'>
                </div>
                <?php
            }
            ?>
            <div class="w200 mrlauto mt16">
                <label class="w100p block fs16" for="mdpold">Ancien mot de passe :</label>
                <div class="w100p flex j-between mt4">
                    <input class="w150" type="password" name="mdpOld" id="mdpOld">
                    <p id="btnMdpOld" class="w30 btn white txt-center">👁</p>
                </div>
            </div>
            <div class="w200 mrlauto mt16">
                <label class="w100p block fs16" for="mdpNew">Nouveau mot de passe :</label>
                <div class="w100p flex j-between mt4">
                    <input class="w150" type="password" name="mdpNew" id="mdpNew">
                    <p id="btnMdpNew" class="w30 btn white txt-center">👁</p>
                </div>
            </div>
            <div class="w200 mrlauto mt16">
                <label class="w100p block fs16" for="mdpVerif">Vérification :</label>
                <div class="w100p flex j-between mt4">
                    <input class="w150" type="password" name="mdpVerif" id="mdpVerif">
                    <p id="btnMdpVerif" class="w30 btn white txt-center">👁</p>
                </div>
            </div>
            <div class="w200 mrlauto mt16 flex j-between a-center">
                <input class="fs14" type="submit" value="Modifier">
                <a class="fs12" href="afficher_accueil.php">Annuler</a>
            </div>
        </form>
        <?php
            if($error == 1){
                ?>
                <p class="w200 mt16 fs12 red mrlauto">Il y a une erreur de saisie sur ton ancien mot de passe ou la vérification de ton nouveau mot de passe</p>
                <?php
            }
        ?>
    </main>
    <script src="js/modification.js" defer></script>
</body>
</html>