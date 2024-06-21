<?php
// controleur : ajoute une vente à la bdd : prd - clt - sn - date
//              si champs vide : retourne : $error : 1 si 1 champ n'est pas renseigné
//                                          $produit : détail du produit vendu
//                                          $client= "" si vide ou $client
//                                          $mailInconnu = 1 si mail inconnu
//                                          $sn= "" si vide ou $sn
//                                          $snIncorrect = 1 si sn incorrect
// parametre : date
//             vendeur
//             $_POST[refProduitVente] : détail du produit vendu
//             $_POST[clientVente]= id du clt
//             $_POST[snVente]= sn du produit


// initialisation
require_once "utils/init.php";
require_once "utils/verif_connexion.php";


// récupération des parametre
$idUser = session_isconnected() ? session_idconnected() : 0;
$idProduit = isset($_POST["idProduit"]) ? $_POST["idProduit"] : "";
$nomClientVente = isset($_POST["nomClientVente"]) ? $_POST["nomClientVente"] : "";
$prenomClientVente = isset($_POST["prenomClientVente"]) ? $_POST["prenomClientVente"] : "";
$mailClientVente = isset($_POST["mailClientVente"]) ? $_POST["mailClientVente"] : "";
$snVente = isset($_POST["snVente"]) ? $_POST["snVente"] : "";


// traitement
if ($nomClientVente != "" && $prenomClientVente != "" && $prenomClientVente != ""){
    $client = new utilisateur();
    $idClient = $client->testId($mailClientVente, $prenomClientVente, $nomClientVente);
    if($idClient == 0){
        $clientInconnu = 1;
    }else{
        $clientInconnu = 0;
    }
}



$produit = new produit($idProduit);
$snOk = $produit->snCorrespond($snVente);
if($snOk == 0) $snIncorrect = 1;
else $snIncorrect = 0;

if($snOk == 1 && $idClient != 0 && $idUser != 0){
    //création de l'objet vente et chargement des éléments avant insertion dans la bdd
    $vente = new vente();
    $vente->set("vendeur", $idUser);
    $vente->set("client", $idClient);
    $vente->set("produit", $idProduit);
    $vente->set("sn", $snVente);
    $date = date("Y-m-d");
    $vente->set("date", $date);
    $vente->insert();
}else{
    header("Location: afficher_form_vente.php?error=1&nomClientVente=$nomClientVente&prenomClientVente=$prenomClientVente&mailClientVente=$mailClientVente&idProduit=$idProduit&snVente=$snVente&clientInconnu=$clientInconnu&snIncorrect=$snIncorrect");
}

// affichage
header("Location: afficher_accueil.php?vente=1");