<?php

class ticket extends _model {

    protected $table = "ticket";
    
    function define(){
        $this->addField("client", "LINK", "Client", "utilisateur");
        $this->addField("produit", "LINK", "Produit", "produit");
        $this->addField("demande");
        $this->addField("statut");
        $this->addField("lastAut", "LINK", "Auteur de la dernière réponse", "utilisateur");
        $this->addField("ouverture");
        $this->addField("fermeture");
        $this->addField("par", "LINK", "Cloturé par", "utilisateur");
    }   

    function listePerso($id){
        // role : récupération des ticket correspondant à l'id
        // parametre : $id - id du client rattaché au ticket
        // retour : $liste - tableau d'objet ticket indexé par l'id

        // construction
        $sql = "SELECT `client`, `produit`, `statut`, `lastAut`, `ouverture` FROM `ticket` WHERE `id` = :id ORDER BY `ouverture` DESC";
        $param = [":id" => $id];

        // préparation
        $bdd = static::bdd();
        $req = $bdd->prepare($sql);

        // execution
        if(!$req->execute($param)){
            // erreur de syntaxe : code de debug
            echo "echec  sql : $sql";
            print_r($param);
            return [];
        }

        // récupération
        $liste = [];
        while($result = $req->fetch(PDO::FETCH_ASSOC)){
            $tick = new ticket();
            $tick->loadFromTab($result);
            $liste[$tick->id()] = $tick;
        }
        
        // retour
        return $liste;
    }
}