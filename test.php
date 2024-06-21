<?php
// controleur de test

// initialisation
require_once "utils/init.php";

// vérification si on est connecté ou non
include "utils/verif_connexion.php";


$ticket = new ticket(2);

print_r($ticket->id());
/*
print_r($ticket);

$ticket->set("statut", "OUV");

print_r($ticket);

$update = $ticket->update();

echo "$update";
*/