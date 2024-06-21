<?php
// template : Affiche la page d'accueil de l'appli - si vendeur : btns histo vente, modif mdp, modif espace, créer clt et enregistrer vente
//                                                 - si tech : btns modif mdp, histo mes tickets, modif espace, liste des tickets ouv/ec avec dernier message =client + liste des ticket ec avec dernier message tech de plus de 72H (pour relance) (si id vendeur : surbrillance de ses clients)
//                                                 - si clt : btns modif info, histo tickets, nv ticket, liste ticket en attente rep et tickets ouvert
// parametre : $id_user : id de l'utilisateur connecté
//             $espace : espace défini à la connexion ou par l'utilisateur
//             $listeAttente : - (si espace tech) liste de tout les tickets ouv/ec avec dernier message = client 
//                             - (si espace client) liste de tout les tickets ouv/ec avec dernier message different client
//             $listeRepondu : - (si espace tech) liste de tout les tickets ouv/ec avec dernier message = client 
//                             - (si espace client) liste de tout les tickets ouv/ec avec dernier message different client
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
        <?php
            if($modif == 1){
                echo "<p id='popModif' class='encart fs14 txt-center'>La modification est bien prise en compte</p>";
            }
            if($idClt != 0){
                echo "<p id='popModif' class='encart fs14 txt-center'>La création du client $prenomClt $nomClt est bien prise en compte</p>";
            }
            if($vente == 1){
                echo "<p id='popModif' class='encart fs14 txt-center'>La vente est bien prise en compte</p>";
            }
            if($ticket == 1){
                echo "<p id='popModif' class='encart fs14 txt-center'>L'ouverture de votre ticket est bien prise en compte'</p>";
            }
            if($cloture == 1){
                echo "<p id='popModif' class='encart fs14 txt-center'>Le ticket est clôturé'</p>";
            }
        ?>
        <!-- section commune au 3 espaces -->
        <section id="commun">
            <div class="flex j-between mt40">
                <div class="flex">
                    <p id="param">⚙️</p>
                    <h3><?= $user->get("prenom") ?></h3>
                </div>
                <?php
                    if($espace === "vendeur"){
                        echo "<a href='afficher_historique.php?historique=vente'><button class='btnPad'>Historique des ventes</button></a>";
                    }else if($espace === "technicien"){
                        echo "<a href='afficher_historique.php?historique=ticketAll'><button class='btnPad'>Tickets archivés</button></a>";
                    }else if($espace === "client"){
                        echo "<a href='afficher_historique.php?historique=ticketPerso'><button class='btnPad'>Mes tickets</button></a>";
                    }
                ?>
            </div>
            <?php if($espace === "client") echo "<div class='flex j-end mt4'><a href='afficher_demande.php'>+ Nouveau ticket</a></div>"; ?>  
        </section>
        <div id="menu" class="encart d-none">
            <a href="deconnecter.php"><button class="btnPad">Deconnexion</button></a>
            <button id="closeMenu" class="btnPad">✖</button>
            <?php
                if($espace === "vendeur" || $espace === "technicien"){
                    echo "<a class='block mt16' href='afficher_modif_info.php'><button class='btnPad'>Modifier mon mot de passe</button></a>";
                }else if($espace === "client"){
                    echo "<a class='block mt16' href='afficher_modif_info.php'><button class='btnPad'>Modifier mes informations</button></a>";
                }
            ?>
        </div>  
        <!-- section spécifique -->
        <section id="espace" class="mt40">
            <?php
                if($espace === "vendeur" || $espace === "technicien"){
                    include "templates/fragments/change_espace.php";
                }
                // appel le fragment correspondant à l'espace
                if($espace === "vendeur"){
                    include "templates/fragments/espace-vendeur.php";
                }else{
                    echo "<div id='tickets' class='mt40'></div>";
                }
            ?>
            </div>
        </section>
    </main>
    <script src="js/param.js" defer></script>
    <?php
        if($popup == 1){
            echo "<script src='js/modif.js' defer></script>";
        }
        if($espace === "vendeur"){
            echo "<script src='js/recherche.js' defer></script>";
        }else{
            echo "<script src='js/ticket.js' defer></script>";
        }
    ?>
</body>
</html>