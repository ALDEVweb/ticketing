<?php
// controleur : ajoute un client dans la bdd nom - prenom - mail - mdp
//              si error, retourne : $error : 1 si 1 champ n'est pas renseigné
//                                   $nom = "" si vide ou $nom
//                                   $prenom = "" si vide ou $prenom
//                                   $mail= "" si vide ou $mail
// parametre : $_POST[nomClient] = nom du client à créer
//             $_POST[prenomClient] = prenom du client à créer
//             $_POST[mailClient]= mail du client à créer
//             $_POSTmdpClient]= mdp du client à créer


// initialisation
require_once "utils/init.php";
require_once "utils/verif_connexion.php";


// récupération des parametre
$nomClient = isset($_POST["nomClient"]) ? $_POST["nomClient"] : "";
$prenomClient = isset($_POST["prenomClient"]) ? $_POST["prenomClient"] : "";
$mailClient = isset($_POST["mailClient"]) ? $_POST["mailClient"] : "";

// traitement
if($nomClient === "" || $prenomClient === "" || $mailClient === ""){
    header("Location: afficher_client.php?error=1&nomClient=$nomClient&prenomClient=$prenomClient&mailClient=$mailClient");
    exit;
}

$client = new utilisateur();
$client->set("type", "client");
$client->set("type", "client");
$client->set("nom", $nomClient);
$client->set("prenom", $prenomClient);
$client->set("mail", $mailClient);
$pwd = $client->genPwd();
$client->setPwd($pwd);
$client->insert();
$param = ["prenom" => $prenomClient, "nom" => $nomClient, "mail" => $mailClient, "pwd" => $pwd];
$envoi = $client->sendConfirm("templates/mails/confirm_creation_client.php", $param);
$idClt = $client->id();

// affichage
header("Location: afficher_accueil.php?client=$idClt");