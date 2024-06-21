<?php
// controleur : si pas d'utilisateur connecté : demande l'affichage de la page de connexion (si error mdp ou login retourne $erroe = 1 sinon 0)
//              si utilisateur connecté, demande l'affichage de la page d'accueil 
//                                       - création des param du template : $user : l'utilisateur connecté
//                                                                          $espace : espace défini à la connexion ou par l'utilisateur
// parametre : $_session[id] : id de l'utilisateur connecté
//             $_session[espace] : espace sur lequel ce situe l'utilisateur
//             $_GET[error] : si il y a une erreur à l'identification
//             $_GET[client] : si un client a été créé
//             $_GET[vente] : si une vente a été effectué


// initialisation
require_once "utils/init.php";

// vérification si on est connecté ou non
include "utils/verif_connexion.php";

// récupération des parametre
$idUser = session_isconnected() ? session_idconnected() : 0;
$espace = isset($_SESSION["espace"]) ? $_SESSION["espace"] : "";
$modif = isset($_GET["modif"]) ? $_GET["modif"] : 0;
$idClt = isset($_GET["client"]) ? $_GET["client"] : 0;
$vente = isset($_GET["vente"]) ? $_GET["vente"] : 0;
$ticket = isset($_GET["ticket"]) ? $_GET["ticket"] : 0;
$cloture = isset($_GET["cloture"]) ? $_GET["cloture"] : 0;
$noProd = isset($_GET["noProd"]) ? $_GET["noProd"] : 0;

// si un client a été créé, je rcupère l'objet utilisateur de ce client
if($idClt != 0){
    $client = new utilisateur($idClt);
    $nomClt = $client->getHTML("nom");
    $prenomClt = $client->getHTML("prenom");
}

if($modif == 1 || $vente == 1 || $idClt != 0 || $ticket == 1 || $cloture == 1){
    $popup = 1;
}else{
    $popup = 0;
}

// traitement
$user = new utilisateur($idUser);
$produit = new produit();
$listproduit = $produit->listAll();


// affichage
include "templates/pages/accueil.php";