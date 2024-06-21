<?php
// controleur : recherche la liste des message lié au ticket et retourne $liste : liste des messages en lien avec le ticket
// parametre : $_GET[idTicket] : id du ticket auquel les message sont lié


// initialisation
require_once "utils/init.php";
require_once "utils/verif_connexion.php";


// récupération des parametre
$idTicket = isset($_SESSION["idTicket"]) ? $_SESSION["idTicket"] : 0;

// traitement
// on instancie un nouvel objet message
$message = new message();
// on récupère la liste de tout les message dont le ticket est id ticket classsé par date décroissante
$listeMsg = $message->listAll(["ticket" => $idTicket], ["+date"]);

// affichage
include "templates/fragments/liste_msg.php";