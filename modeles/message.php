<?php

class message extends _model {

    protected $table = "message";

    function define(){
        $this->addField("contenu");
        $this->addField("ticket", "LINK", "Ticket", "ticket");
        $this->addField("auteur", "LINK", "Auteur", "utilisateur");
        $this->addField("date");
    }
}