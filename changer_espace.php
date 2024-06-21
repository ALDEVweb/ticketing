<?php
// controleur : change l'espace afficher via $_SESSION[espace] - vente si tech et tech si vente
// parametre : $_GET[espace] : espace affiché sur l'accueil


// initialisation
require_once "utils/init.php";
require_once "utils/verif_connexion.php";


// récupération des parametre
$espace = isset($_GET["espace"]) ? $_GET["espace"] : "";

// traitement
$_SESSION["espace"] = $espace;

// affichage
header("Location: afficher_accueil.php");