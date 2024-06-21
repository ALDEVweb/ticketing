<?php
// controleur : change le statut du ticket dans la bdd : statut - date fermeture - cloture_par
// parametre : $_session[id] : id de l'utilisateur connecté
//             $_GET[idTicket] : id du ticket auquel rattacher le message


// initialisation
require_once "utils/init.php";
require_once "utils/verif_connexion.php";


// récupération des parametre
$idUser = session_isconnected() ? session_idconnected() : 0;
$idTicket = isset($_GET["idTicket"]) ? $_GET["idTicket"] : 0;

// traitement
// instanciation du ticket concerné
$ticket = new ticket($idTicket);
// chargement du statut avec CLO
$ticket->set("statut", "CLO");
// chargement de par avec idUser
$ticket->set("par", $idUser);
// chargement de la date de fermeture
$date = date("Y-m-d H:i:s");
$ticket->set("par", $date);
// maj du ticket dans la bdd
$ticket->update();

// affichage
header("Location: afficher_accueil.php?cloture=1");