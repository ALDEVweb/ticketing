<?php
// controleur : demande l'affichahe du formulaire d'enregistrement d'une vente
// parametre : $_GET[error] : 1 si 1 champ n'est pas renseigné
//             nomClientVente - prenomClientVente - mailClientVente (info du client)
//             clientInconnu - 1 si recherche du client dans la base a echoué
//             produitVente (id du produit vendu)
//             snVente (n°série du produit renseigné par le vendeur)
//             snIncorrect - 1 si incorrect


// initialisation
require_once "utils/init.php";
require_once "utils/verif_connexion.php";


// récupération des parametre
if(isset($_POST["idProduit"])) $idProduit = $_POST["idProduit"];
else if(isset($_GET["idProduit"])) $idProduit = $_GET["idProduit"];
else $idProduit = 0;

if($idProduit == 0){
    header("Location: afficher_accueil.php?noProd=1");
}

$error = isset($_GET["error"]) ? $_GET["error"] : 0;
$nomClientVente = isset($_GET["nomClientVente"]) ? $_GET["nomClientVente"] : "";
$prenomClientVente = isset($_GET["prenomClientVente"]) ? $_GET["prenomClientVente"] : "";
$mailClientVente = isset($_GET["mailClientVente"]) ? $_GET["mailClientVente"] : "";
$clientInconnu = isset($_GET["clientInconnu"]) ? $_GET["clientInconnu"] : 0;
$snVente = isset($_GET["snVente"]) ? $_GET["snVente"] : "";
$snIncorrect = isset($_GET["snIncorrect"]) ? $_GET["snIncorrect"] : 0;


// traitement
$produit = new produit($idProduit);
$designProduitVente = $produit->get("design");



// affichage
include "templates/pages/form_vente.php";