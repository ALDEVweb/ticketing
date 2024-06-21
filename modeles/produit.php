<?php

class produit extends _model {

    protected $table = "produit";
    
    function define(){
        $this->addField("ref");
        $this->addField("design");
        $this->addField("ev");
    }

    function snCorrespond($snVente){
        // role : compare les 7 premier caractères du sn avec la ref du produit
        // parametre : $ref - ref du produit comparé et 
        //             $snVente - n°série a comparé
        //retour : 1 si ok 0 sinon;

        // préparation de la chaine a comparer
        $snCut = substr($snVente, 0, 7);

        // si la ref est égal a la chaine coupé et la longueur total = à 15, je retourne 1, sinon 0
        if($snCut === $this->get("ref") && strlen($snVente) === 15){
            return 1;
        }else{
            return 0;
        }
    }

        function idRef($ref){
            // role : récupère l'id d'un produit via sa reférence
            // parametre : $ref - ref du prdouit
            // retour : $id - id du produit

            // construction
            $sql = "SELECT `id` FROM `produit` WHERE `ref` = :ref";
            $param = [":ref" => $ref];

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