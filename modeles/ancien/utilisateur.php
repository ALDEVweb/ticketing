<?php

class utilisateur extends _user {

    protected $table = "utilisateur";
    protected $fields = ["type", "nom", "prenom", "mail", "mdp"];

    const LOGIN = "mail";
    const PWD = "mdp";

    function testId($mail, $prenom, $nom){
        // role : récupère l'id de l'utilisateur répondant aux parametre
        // parametre : $mail, prenom et nom - de l'utilisateur recherché
        // retour : $id de l'utilisateur

        // construction
        $sql = "SELECT `id` FROM `utilisateur` WHERE `mail` = :mail AND `prenom` = :prenom AND `nom` = :nom";
        $param = [":mail" => $mail, ":nom" => $nom, ":prenom" => $prenom];

        //préparation
        $bdd = static::bdd();
        $req = $bdd->prepare($sql);

        //execution
        if(!$req->execute($param)){
            // erreur de syntaxe : code de debug
            echo "echec sql : $sql";
            print_r($param);
            return 0;
        }

        //recupération
        $result = $req->fetch(PDO::FETCH_ASSOC);
        if(isset($result)){
            $id = $result["id"];
        }else{
            $id = 0;
        }

        // retour
        return $id;
    }
    
}