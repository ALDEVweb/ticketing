<?php
// controleur : verifie que l'ancien mdp corresponde bien au mdp enregistré, verifie que new mdp et mdpconfirm soit les memes
//              si oui, enregistre new mdp dans bdd (+ mail  si idUser = client)
//              si erreur : retourne au formulaire avec variable : $error = 1
//                                                                 
// parametre : $_session[id] : id de l'utilisateur a modif
//             $_POST[oldMdp] : ancien mdp de l'utilisateur
//             $_POST[newMdp] : nouveau mdp
//             $_POST[mdpConfirm] : verification mdp
//             $_POST[mail] : mail du client si viens du form client


// initialisation
require_once "utils/init.php";
require_once "utils/verif_connexion.php";


// récupération des parametre
$idUser = session_isconnected() ? session_idconnected() : 0;
$espace = isset($_SESSION["espace"]) ? $_SESSION["espace"] : "";
$mdpOld = isset($_POST["mdpOld"]) ? $_POST["mdpOld"] : "";
$mdpNew = isset($_POST["mdpNew"]) ? $_POST["mdpNew"] : "";
$mdpVerif = isset($_POST["mdpVerif"]) ? $_POST["mdpVerif"] : "";
// test la correspondance du mot de passe avec le mdp de la base de donnée
$user = new utilisateur($idUser);
$userConnect = $user->loginVerify($user->get("mail"), $mdpOld);
// si correspond pas, renvoi au formulaire avec msg d'erreur
// verification du resultat, si erreur de comparaison, on retourne une erreur
if($userConnect === 0 || $mdpNew !== $mdpVerif){
    header("Location: afficher_modif_info.php?error=1");
    exit;
}
// sinon c'est que c'est tout bon, on enregistre les modif et renvoi à l'accueil
$user->setPwd($mdpNew);
// si user connecté est un client je récupère le mail et le modifie
if($espace === "client"){
    $mail = isset($_POST["mail"]) ? $_POST["mail"] : "";
    $user->set("mail", $mail);
}
$user->update();
// affichage
header("Location: afficher_accueil.php?modif=1");