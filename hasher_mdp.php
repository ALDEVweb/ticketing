<?php
// initialisation
require_once "utils/init.php";

$user = new utilisateur();

$user->setPwd("Azerty@123");

$hash = $user->get("mdp");

echo "$hash";