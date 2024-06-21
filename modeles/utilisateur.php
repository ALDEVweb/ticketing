<?php

class utilisateur extends _user {

    const LOGIN = "mail";
    const PWD = "mdp";

    protected $table = "utilisateur";
    
    function define(){
        $this->addField("type");
        $this->addField("nom");
        $this->addField("prenom");
        $this->addField("mail");
        $this->addField("mdp");
    }

    function testId($mail, $prenom, $nom){
        // role : récupère l'id de l'utilisateur répondant aux parametre
        // parametre : $mail, prenom et nom - de l'utilisateur recherché
        // retour : $id de l'utilisateur

        // construction
        $sql = "SELECT `id` FROM `utilisateur` WHERE `mail` = :mail AND `prenom` = :prenom AND `nom` = :nom";
        $param = [":mail" => $mail, ":nom" => $nom, ":prenom" => $prenom];

        //préparation
        $req = $this->runSql($sql, $param);

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