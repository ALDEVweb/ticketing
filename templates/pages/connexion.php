<?php
// template : Affiche la page de connexion : champ mail, mdp + btns oeil, connexion et annuler + msg d'erreur si necessaire
// parametre : $error : 1 si erreur mdp ou login
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="blue">
    <?php include "templates/fragments/header.php"; ?>
    <main class="w300 mrlauto blue">
        <h2 class="fs20 mt40">Connexion</h2>
        <form class="encart mt40" action="connecter.php" method="POST">
            <div class="w200 mrlauto">
                <label class="w100p block fs16" for="login">Email</label>
                <input class="w100p mt4" type="text" name="login" id="login">
            </div>
            <div class="w200 mrlauto mt16">
                <label class="block w100p fs16" for="mdp">Mot de passe</label>
                <div class="w100p flex j-between mt4">
                    <input class="w150" type="password" name="mdp" id="mdp">
                    <p id="btnMdp" class="w30 btn white txt-center">👁</p>
                </div>
            </div>  
            <div class="w200 mrlauto mt16 flex j-between a-center">
                <input class="fs14" type="submit" value="connexion">
                <a class="fs12" href="">Mot de passe oublié</a>
            </div>
            <?php
                if($error == 1){
                    ?>
                    <p class="w200 mt16 fs12 red mrlauto">Il y a une erreur de saisie sur ton email ou ton mot de passe</p>
                    <?php
                }
            ?>  
        </form>
    </main>
    <script src="js/connexion.js" defer></script>
</body>
</html>