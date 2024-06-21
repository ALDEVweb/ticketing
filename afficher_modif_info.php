<?php
// controleur : demande l'affichage du formulaire de modification des infos - création des param du template : $id_user : id de l'utilisateur connecté 
//                                                                                                             $mail : mail de l'utilisateur(si id est un client)
//                                                                                                             $error
// parametre : id : id de l'utilisateur via session si utilisateur connecté, ou get si premiere connexion
//             $_session[espace] : espace sur lequel ce situe l'utilisateur


// initialisation
require_once "utils/init.php";
require_once "utils/verif_connexion.php";


// récupération des parametre
$idUser = session_isconnected() ? session_idconnected() : 0;
$espace = isset($_SESSION["espace"]) ? $_SESSION["espace"] : "";

// traitement
$user = new utilisateur($idUser);
$mail = $user->get("mail");

// affichage
include "templates/pages/modif_info.php";