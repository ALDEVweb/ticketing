<?php 

/* code d'initialisation à insérer en début de chaque contrôleur */

// gestion et affichage des erreurs
ini_set("display_errors", 1);       // Aficher les erreurs
error_reporting(E_ALL);             // Toutes les erreurs

include "utils/field.php";
include "utils/model.php";
include "utils/user.php";

// ouverture de la base de donnée
$bdd = _model::bdd();

// propriété de debug
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

// chargement des librairies

include "modeles/utilisateur.php";
include "modeles/produit.php";
include "modeles/vente.php";
include "modeles/ticket.php";
include "modeles/message.php";
include "utils/session.php";


// activation du mécanisme de session
session_activation();



