<?php
// template : affiche le détail d'un ticket : client, produit, ref, demande, statut + btn fermer et repondre
//            ainsi qu'une zone d'affichage de la liste des message liés + un msg de confirmation de fermeture du ticket via javascript (caché par défaut)
// parametre : $ticket : détail d'un ticket
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
        <main class="w300 mrlauto">
            <div class="flex j-between a-center mt40">
                <h2 class="fs20">Ticket <?= $idTicket ?></h2>
                <a href="afficher_accueil.php"><button class="btnPad">Accueil</button></a>
            </div>
            <div class="flex j-between a-center mt40">
                <div>
                    <ul>
                        <?php
                            if($espace != "client") echo "<li>$nomClient $prenomClient</li>";
                        ?>
                        <li class="mt8"><?= $designProd ?></li>
                        <li class="mt8"><?= $refProd ?></li>
                    </ul>
                </div>
                <div id="containConfirm">
                    <ul>
                        <li class="mt8"><?= $ticket->get("statut") ?></li>
                        <?php
                            if($ticket->get("statut") != "CLO") echo "<li class='mt16'><button id='cloture' class='btnPad'>Cloturer</button></li>";
                        ?>
                    </ul>
                    <div id="confirm" class="encart d-none">
                        <h3 class="txt-center">Confirmer la clôture du ticket</h3>
                        <div class="flex j-around mt40">
                            <button id="annule" class="btnPad">Non</button>
                            <a href="fermer_ticket.php?idTicket=<?= $idTicket ?>"><button class="btnPad">Oui</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <p><?= $ticket->get("demande") ?></p>
            <form class="mt16" action="envoyer_message.php" method="POST">
                <input type="number" name="idTicket" id="idTicket" class="d-none" value="<?= $idTicket ?>">
                <div>
                    <textarea class="w100p h60" name="contenu" id="contenu"></textarea>
                </div>
                <div class="flex j-end">
                    <input class="mt8" type="submit" value="Répondre">
                </div>
            </form>
            <div id="listMsg" class="mt16">
                
            </div>
        </main>
        <script src="js/msg.js" defer></script>
</body>
</html>