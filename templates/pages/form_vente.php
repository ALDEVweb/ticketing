<?php
// template : affiche le formulaire de création d'une vente avec champ client, produit, sn, date et btns valider et annuler
// parametre : $produit : détail du produit vendu
//             $error : 1 si 1 champ n'est pas renseigné
//             $client= 1 si vide ou $client
//             $sn= 1 si vide ou $sn
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
        <h2 class="fs20 mt40">Vente produit</h2>
        <form class="encart mt40" action="enregistrer_vente.php" method="POST">
        <?php
            if($error == 1 && $clientInconnu == 1){
                echo "<p class='w200 mt4 mb16 fs12 red mrlauto'>Le client est inconnu, veuillez créer un nouveau client - <a href='afficher_client.php'><u>Créer un client</u></a></p>";
            }
        ?>
        <div class="w200 mrlauto">
                <label class='w100p block fs16' for='nomClientVente'>Nom :</label>
                <input class="w100p mt4" type='text' name='nomClientVente' id='nomClientVente' value='<?= nl2br(htmlentities($nomClientVente)) ?>'>
                <?php
                    if($error == 1 && $nomClientVente == ""){
                        echo "<p class='w200 mt4 fs12 red mrlauto'>Veuillez saisir un Nom</p>";
                    }
                ?>
            </div>
            <div class="w200 mrlauto mt16">
                <label class='w100p block fs16' for='prenomClientVente'>Prenom :</label>
                <input class="w100p mt4" type='text' name='prenomClientVente' id='prenomClientVente' value='<?= nl2br(htmlentities($prenomClientVente)) ?>'>
                <?php
                    if($error == 1 && $prenomClientVente == ""){
                        echo "<p class='w200 mt4 fs12 red mrlauto'>Veuillez saisir un prénom</p>";
                    }
                ?>
            </div>
            <div class="w200 mrlauto mt16">
                <label class='w100p block fs16' for='mailClientVente'>Mail :</label>
                <input class="w100p mt4" type='email' name='mailClientVente' id='mailClientVente' value='<?= nl2br(htmlentities($mailClientVente)) ?>'>
                <?php
                    if($error == 1 && $mailClientVente == ""){
                        echo "<p class='w200 mt4 fs12 red mrlauto'>Veuillez saisir un mail</p>";
                    }
                ?>
            </div>
            <div class="w200 mrlauto mt16">
                <label class='w100p block fs16' for='designProduitVente'>Produit :</label>
                <input class="w100p mt4" type='text' name='designProduitVente' id='designProduitVente' value='<?= nl2br(htmlentities($designProduitVente)) ?>'>
                <?php
                    if($error == 1 && $designProduitVente == ""){
                        echo "<p class='w200 mt4 fs12 red mrlauto'>Veuillez selectionner un produit</p>";
                    }
                ?>
            </div>
            <input class="d-none" type="number" name="idProduit" id="idProduit" value="<?= $idProduit ?>">
            <div class="w200 mrlauto mt16">
                <label class='w100p block fs16' for='snVente'>N° de série :</label>
                <input class="w100p mt4" type='text' name='snVente' id='snVente' value='<?= nl2br(htmlentities($snVente)) ?>'>
                <?php
                    if($error == 1 && ($snVente == "" || $snIncorrect == 1)){
                        echo "<p class='w200 mt4 fs12 red mrlauto'>Veuillez saisir un n° de série valide</p>";
                    }
                ?>
            </div>
            <div class="w200 mrlauto mt16 flex j-between a-center">
                <input class="fs14" type="submit" value="Valider">
                <a class="fs12" href="afficher_accueil.php">Annuler</a>
            </div>
        </form>
    </main>
    <script src="js/recherche.js" defer></script>
</body>
</html>