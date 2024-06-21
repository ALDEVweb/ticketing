<?php
// template : affiche l'historique : - des vente si espace vente
//                                   - des tickets traité si espace tech
//                                   - des tickets si espace client
// parametre : $histo : historique - des vente si espace vente
//                                 - des tickets traité si espace tech
//                                 - des tickets si espace client
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
        <div class="flex j-between a-center mt40">
            <h2 class="fs20">Historique <?= $histo ?></h2>
            <a class="fs12" href="afficher_accueil.php"><button class="btnPad">Retour</button></a>
        </div>
        <div class="w100p encart mt40">
            <table class="mrlauto">
                <?php
                    if($espace == "vendeur"){
                        include "templates/fragments/histo_ventes.php";
                    }else if($espace == "technicien"){
                        include "templates/fragments/histo_tickets.php";
                    }else if($espace == "client"){
                        include "templates/fragments/histo_tickets_client.php";
                    }
                ?>
            </table>
        </div>
    </main>
    <script src="js/historique.js" defer></script>
</body>
</html>