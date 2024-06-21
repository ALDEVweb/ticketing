<?php
// controleur ajax : récupère la liste des ticket ouv et en cours (soit tous si tech ou vendeur) (soit perso si client) et en demande l'affichage (ajax+fragment)
//                   préparation des parametre du fragment : - $listeAttente : - (si espace tech) liste de tout les tickets ouv/ec avec dernier message = client 
//                                                                             - (si espace client) liste de tout les tickets ouv/ec avec dernier message different client
//                                                           - $listeRepondu : - (si espace tech) liste de tout les tickets ouv/ec avec dernier message = client 
//                                                                             - (si espace client) liste de tout les tickets ouv/ec avec dernier message different client
// parametre : $_session[id] : id de l'utilisateur connecté
//             $_session[espace] : espace sur lequel ce situe l'utilisateur


// initialisation
require_once "utils/init.php";

// vérification si on est connecté ou non
include "utils/verif_connexion.php";

// récupération des parametre
$idUser = session_isconnected() ? session_idconnected() : 0;
$espace = isset($_SESSION["espace"]) ? $_SESSION["espace"] : "";

// traitement
// préparation de l'objet ticket
$tickets = new ticket();
// préparation des tableau liste attente et liste répondu
$listeAttente = [];
$listeRepondu = [];
// création des liste ticket en attente et ticket repondu
if($espace === "technicien"){
    // si affiche l'espace technicien
    // je récupère tout les ticket ouvert et en cours
    $liste = $tickets->listAll([], ["+ouverture"]);
    // pour chaque ticket
    foreach($liste as $id => $ticket){
        // si statut ouvert ou en cours
        if($ticket->get("statut") != "CLO"){
            // si lastauteur correspond au client : je stock dans la liste en attente de rep
            if($ticket->get("lastAut") === $ticket->get("client")){
                $listeAttente[$ticket->id()] = $ticket;
            }else{
                // sinon : je stock dans la liste répondu
                $listeRepondu[$ticket->id()] = $ticket;
            }
        }
    }            
}else if($espace === "client"){
    // sinon, si affiche espace client
    // je récupère les tickets ouvert et en cours me concernant
    $liste = $tickets->listAll(["client" => $idUser], ["+ouverture"]);
    // pour chaque ticket
    foreach($liste as $id => $ticket){
        // si statut ouvert ou en cours
        if($ticket->get("statut") != "CLO"){
            if($ticket->get("lastAut") == $idUser){
                // si correspond au client, je stock dans la liste repondu
                $listeRepondu[$ticket->id()] = $ticket;
            }else{
                // sinon, je stock dans la liste en attente de rep
                $listeAttente[$ticket->id()] = $ticket;
            }
        }
    }
}

// retour
include "templates/fragments/liste_ticket.php";