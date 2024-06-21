<?php
/*

Code à inclure dans les controleurs qui ont besoin de la connexion

*/

// surveillance d'une erreur de connexion en parametre
$error = isset($_GET["error"]) ? $_GET["error"] : 0;

// Si on n'est pas connexté : rediriger / afficher le formulaire de connexion
if ( ! session_isconnected()) {
    include "templates/pages/connexion.php";
    exit;
}