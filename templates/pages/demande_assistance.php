<?php
// template : affiche le formulaire de création d'une demande d'assistance avec produit concerné et message, + btns valider ou annuler
// parametre : $error : 1 si 1 champ n'est pas renseigné
//             $produit = 1 si pas renseigné ou le produit
//             $dde = 1 si pas renseigné ou le produit
//             $listeprod = liste des produit acheté par le client
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
        <h2 class="fs20 mt40">Demande d'assistance</h2>
        <form class="encart mt40" action="envoyer_demande.php" method="POST">
        <div class="w200 mrlauto">
                <label class='w100p block fs16' for='idProduit'>Sélection produit :</label>
                <select class="w100p mt4" name='idProduit' id='idProduit'>
                    <?php include "templates/fragments/select_produit.php"; ?>
                </select>
                <?php
                    if($error == 1 && $idProduit == ""){
                        echo "<p class='w200 mt4 fs12 red mrlauto'>Veuillez sélectionner un produit</p>";
                    }
                ?>
            </div>
            <div class="w200 mrlauto mt16">
                <label class='w100p block fs16' for='dde'>Votre demande :</label>
                <textarea class="w100p mt4" type='text' name='dde' id='dde'><?= nl2br(htmlentities($demande)) ?></textarea>
                <?php
                    if($error == 1 && $demande == ""){
                        echo "<p class='w200 mt4 fs12 red mrlauto'>Veuillez formuler votre demande</p>";
                    }
                ?>
            </div>
            <div class="w200 mrlauto mt16 flex j-between a-center">
                <input class="fs14" type="submit" value="Ouvrir le ticket">
                <a class="fs12" href="afficher_accueil.php">Annuler</a>
            </div>
        </form>
    </main>
</body>
</html>