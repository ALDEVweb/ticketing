<?php
// controleur : sauvegarde le message dans la bdd : auteur (prenom user) - ticket - contenu - date + maj le ticket : statut = ec et lastAut
// parametre : $_session[id] : id de l'utilisateur connecté
//             $idTicket : id du ticket auquel rattacher le message
//             $msg : contenu du message


// initialisation
require_once "utils/init.php";
require_once "utils/verif_connexion.php";


// récupération des parametre
$idUser = session_isconnected() ? session_idconnected() : 0;
$idTicket = isset($_POST["idTicket"]) ? $_POST["idTicket"] : 0;
$msg = isset($_POST["contenu"]) ? $_POST["contenu"] : 0;


// traitement
// gestion msg
    // instanciation du msg
    $message = new message();
    // instanciation de lutilisateur auteur du message
    $auteur = new utilisateur($idUser);
    // chargement de son prénom dans le champ auteur du msg
    $message->set("auteur", $idUser);
    // chargement de l'idTicket dans le champ ticket
    $message->set("ticket", $idTicket);
    // chargement du message dans le champ contenu
    $message->set("contenu", $msg);
    // création de la date
    $date = date("Y-m-d H:i:s");
    // chargement de la date dans le champ date
    $message->set("date", $date);
    // insertion du msg dans la bdd
    $message->insert();
// gestion du ticket
    // instanciation du ticket concerné
    $ticket = new ticket($idTicket);
    // chargement du statut EC dans le champ statut
    $ticket->set("statut", "EC");
    // chargement de idUser dans le champ lastAut
    $ticket->set("lastAut", $idUser);
    // maj du ticket dans la bdd
    $ticket->update();


// affichage
header("Location: afficher_ticket.php?idTicket=$idTicket");
