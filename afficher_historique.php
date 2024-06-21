<?php
// controleur : demande l'affichage du template historique - création des param du template : $histo : historique - des vente si espace vente
//                                                                                                                - des tickets traité si espace tech
//                                                                                                                - des tickets si espace client
// parametre : $_session[id] : id de l'utilisateur connecté
//             $_session[espace] : espace sur lequel ce situe l'utilisateur


// initialisation
require_once "utils/init.php";
require_once "utils/verif_connexion.php";


// récupération des parametre
$idUser = session_isconnected() ? session_idconnected() : 0;
$espace = isset($_SESSION["espace"]) ? $_SESSION["espace"] : "";

// traitement
// si espace vendeur - on récupère la liste de toute les vente
if($espace == "vendeur"){
    $vente = new vente();
    $liste = $vente->listAll([], ["+date"]);
    $histo = "des ventes";
}else if($espace == "technicien"){
    // sinon si espace technicien - on récupère la liste de tout les tickets
    $ticket = new ticket();
    $liste = $ticket->listAll([], ["+ouverture"]);
    $histo = "des tickets";
}else if($espace == "client"){
    // sinon si espace client - on récupère la liste des ticket du client
    $ticket = new ticket();
    $liste = $ticket->listAll(["client" => $idUser], ["+ouverture"]);
    //$liste = $ticket->listePerso($idUser);
    $histo = "de mes tickets";
}

// affichage
include "templates/pages/historique.php";