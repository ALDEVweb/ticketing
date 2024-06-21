<?php

class vente extends _model {

    protected $table = "vente";

    function define(){
        $this->addField("vendeur", "LINK", "Vendeur", "utilisateur");
        $this->addField("client", "LINK", "Client", "utilisateur");
        $this->addField("produit", "LINK", "Produit", "produit");
        $this->addField("sn");
        $this->addField("date");
    }

}