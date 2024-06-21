<?php
// controleur : enregistre la demande dans la bdd : client - produit - demande - statut = ouv - ouverture
//              si erreur retour au formulaire avec variable : $error : 1 si 1 champ n'est pas renseigné
//                                                             $produit = 1 si pas renseigné ou le produit
//                                                             $dde = 1 si pas renseigné ou le produit
// parametre : $_session[id] : id de l'utilisateur connecté
//             $_POST[idProduit] : id du produit concerné par la demande
//             $_POST[dde] : detail de la dde


// initialisation
require_once "utils/init.php";
require_once "utils/verif_connexion.php";


// récupération des parametre
$client = session_isconnected() ? session_idconnected() : 0;
$idProduit = !empty($_POST["idProduit"]) ? $_POST["idProduit"] : 0;
$demande = isset($_POST["dde"]) ? $_POST["dde"] : "";

// traitement
// si l'un des champs est vide, on retourne sur le formulaire
if($idProduit == 0 || $demande == ""){
    header("Location: afficher_demande.php?error=1&idProduit=$idProduit&dde=$demande");
    exit;
}

$ticket = new ticket();
$date = date("Y-m-d H:i:s");
$infosTick = ["client" => $client, "produit" => $idProduit, "demande" => $demande, "statut" => "OUV", "ouverture" => $date, "lastAut" => $client];
$ticket->loadFromTab($infosTick);
$ticket->insert();

// affichage
header("Location: afficher_accueil.php?ticket=1");