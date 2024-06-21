<?php
// controleur : deconnecte l'utilisateur 
// parametre : $_SESSION[id] : id de l'utilisateur a deconnecter


// initialisation
require_once "utils/init.php";
require_once "utils/verif_connexion.php";

// traitement
session_deconnect();

// affichage
header("Location: afficher_accueil.php");
exit;