<?php
// controleur : controle que le login et mdp correspondent bien à un utilisateur de la bdd et le connecte en mettant $session [id] avec l'id de l'utilisateur et ¤session[espace] par défaut en fonction du type d'utilisateur
// parametre : $_POST[login] : mail de la personne qui se connecte
//             $_POST[mdp] : mdp de la personne qui se connecte


// initialisation
require_once "utils/init.php";


// récupération des parametre
$login = isset($_POST["login"]) ? $_POST["login"] : "";
$mdp = isset($_POST["mdp"]) ? $_POST["mdp"] : "";
// traitement
// création d'un nouvel objet utilisateur
$user = new utilisateur();
// application de la méthode de comparaison des parametres avec la base de donnée (récupération de l'id et du type d'utilisateur)
$idUser = $user->loginVerify($login, $mdp);
// verification du resultat, si erreur de comparaison, on retourne une erreur
if($idUser === 0){
    header("Location: afficher_accueil.php?error=1");
    exit;
}
// connexion de l'utilisateur
session_connect($idUser);
// renseignement de l'espace utilisateur par défaut
$_SESSION["espace"] = $utilisateurConnect->get("type");
// affichage
// redirection vers le controleur d'affichage de la page d'accueil
header("Location: afficher_accueil.php");
exit;