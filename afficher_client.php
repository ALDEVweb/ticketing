<?php
// controleur : demande l'affichage du formulaire de création d'un client
// parametre : $_GET[error] : 1 si 1 champ n'est pas renseigné
//             $_GET[nom] = "" si vide ou $nom
//             $_GET[prenom] = "" si vide ou $prenom
//             $_GET[mail]= "" si vide ou $mail


// initialisation
require_once "utils/init.php";
require_once "utils/verif_connexion.php";


// récupération des parametre
$error = isset($_GET["error"]) ? $_GET["error"] : 0;
$nomClient = isset($_GET["nomClient"]) ? $_GET["nomClient"] : "";
$prenomClient = isset($_GET["prenomClient"]) ? $_GET["prenomClient"] : "";
$mailClient = isset($_GET["mailClient"]) ? $_GET["mailClient"] : "";

// traitement
// pas de traitement

// affichage
include "templates/pages/client.php";