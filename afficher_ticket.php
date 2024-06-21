<?php
// controleur : demande l'affichage d'un ticket : retourne $ticket : détail d'un ticket + espace connecté (si client ou non) + pour surveillance mqsg en ajax, on stock idTicket dans la session
// parametre : $_GET[idTicket] : id du ticket à afficher


// initialisation
require_once "utils/init.php";
require_once "utils/verif_connexion.php";


// récupération des parametre
$espace = isset($_SESSION["espace"]) ? $_SESSION["espace"] : "";
$idTicket = isset($_GET["idTicket"]) ? $_GET["idTicket"] : 0;



// traitement
// instanciation du ticket concerné
$ticket = new ticket($idTicket);
// récupération des nom prénom client
$client = $ticket->getTarget("client");
$nomClient = $client->get("nom");
$prenomClient = $client->get("prenom");
// récupération des design ref du ticket
$produit = $ticket->getTarget("produit");
$designProd = $produit->get("design");
$refProd = $produit->get("ref");
// sauvegarde idticket dans la session
$_SESSION["idTicket"] = $idTicket;

// affichage
include "templates/pages/detail_ticket.php";