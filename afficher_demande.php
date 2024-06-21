<?php
// controleur : demande l'affichage du formulaire d'assistance
// parametre : error : si un champ est mal ou non rempli
//             idProduit - produit : le produit concerné par la dde
//             idProduit - le detail de la demande


// initialisation
require_once "utils/init.php";
require_once "utils/verif_connexion.php";

// récupération des parametre
$error = isset($_GET["error"]) ? $_GET["error"] : 0;
$idProduit = isset($_GET["idProduit"]) ? $_GET["idProduit"] : "";
$demande = isset($_GET["dde"]) ? $_GET["dde"] : "";
$idUser = isset($_SESSION["id"]) ? $_SESSION["id"] : 0;

// traitement
$vente = new vente();
// construction des filtre
$filtre = ["client" => $idUser];
// requete et stockage
$listAchat = $vente->listAll($filtre); // a rajouter par la suite filtre produit acheter il y a moins d'un an

if($idProduit > 0){
    $produitDde = new produit($idProduit);
    $nomProduitDde = $produitDde->get("design");
} 
else{
    $nomProduitDde = "";
} 

// affichage
include "templates/pages/demande_assistance.php";