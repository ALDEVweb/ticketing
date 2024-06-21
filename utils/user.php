<?php

/*

classe user étendu de la classe model

    Utilisation :

        * Parametrage :
            const LOGIN = "" - champ utilisé pour stocker l'identifiant
            const PWD = "" - champ utilisé pour stockerle mot de passe
            
        * Méthodes :
            genPwd() : génère un mot de passe automatique
            setPwd($pwd) : crypte le mdp et le charge dans le champ "pwd" (nom à adapter au projet - mdp, pwd, etc..) de l'objet courant (condition : mini 8 caractere, dont 1 majuscule, 1 chiffre et 1 carctere spécial)
            sendConfirm() : envoie un mail de confirmation avec le mot de passe auto
            loginVerify($login, $pwd) : verifie la concordance du mot de passe saisie et enregistré (nom du champ login à adapter au projet, idem pour le mdp)
            
*/

class _user extends _model {

    const LOGIN = "";
    const PWD = "";

    function genPwd(){
        // role : génère un mot de passe automatique
        // parametre : aucun
        // retour : une chaine de caractere avec le mot de passe si ok ou vierge sinon
        
        // spécification des caractère, 1 majuscule, 1 chiffre, 1 caractere spé, et 5 lettre minuscule
        
        $majuscule = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $special = "@[]^_!\"#$%&\'()*+,-./:;{}<>=|~?"; 
        $minuscule = "abcdefghijklmnopqrstuvwxyz";

        // génération
        $int = random_int(0, 8);
        $maj = $majuscule[random_int(0, strlen($majuscule)-1)];
        $spe = $special[random_int(0, strlen($special)-1)];
        $min = "";
        for($i=0; $i<5; $i++){
            $min .= $minuscule[random_int(0, strlen($minuscule)-1)];
        }
        
        // mélange
        $pwd = $int . $maj . $min . $spe;
        $pwd = str_shuffle($pwd);
        // retour
        return $pwd;
    }

    function setPwd($pwd){
        // role : crypte le mdp (condition : mini 8 caractere, dont 1 majuscule ([A-Z]), 1 chiffre (/\d/) et 1 carctere spécial (/[\W_]/))
        //        puis le charge à l'emplacement du mdp (nom à adapter au projet)
        // parametre : $pwd - le mdp à crypté
        // retour : true / false

        // si le mdp ne rempli pas toute les condition, je retourne false
        if(strlen($pwd) < 8 || preg_match('/\d/', $pwd) == 0 || preg_match('/[A-Z]/', $pwd) == 0 || preg_match('/[\W_]/', $pwd) == 0) return false;

        // hash le mdp et le charge dans l'objet courant
        $hash = password_hash($pwd, PASSWORD_DEFAULT);
        $this->fields[$this::PWD]->set($hash);

        // retour
        return true;
    }

    function sendConfirm($template, $param){
        // role : envoie un mail de confirmation avec le mot de passe auto
        // parametre : $template - le nom du template à inclure
        //             $param - un tableau indexé avec les infos necessaire à l'envoi du mail ex ["nom" => valeurNom, etc...]
        // retour : send / echec

        // destinataire
        $prenom = $param["prenom"];
        $nom = $param["nom"];
        $mailTo = "alaugier@mywebecom.ovh"; // ceci est pour les test, en condition réel, il faudra mettre $param["mail"]
        $to = "'$prenom $nom' <$mailTo>";
        // sujet
        $subject = "Confirmation de votre inscription";
        //expediteur
            // en tete
            $head = [];
            $head["From"] = "'Ticketing' <laugierantoine@gmail.com>";
            $head["reply-to"] = "laugierantoine@gmail.com";
            // info pour création mail html
            $head["MIME-Version"] = "1.0";
            $head["Content-Type"] = "text/html; charset=UTF-8";
        // insertion template
        ob_start();
        include "$template";
        $message = ob_get_clean();
        //retour
        if(mail($to, $subject, $message, $head)) return "Send";
        else return "Echec";
    }

    // action sur la bdd
    function loginVerify($login, $pwd){
        // role : verifie la concordance du mot de passe saisie avec celui enregistré
        // parametre : $login - identifiant de l'utilisateur (nom du champ recherché à adapter au projet - nom, mail, etc..)
        //             $pwd - mdp saisi par l'utilisateur à comparer avec le champ mdp (nom à adapter au projet - mdp, pwd, etc..)
        // retour : l'id de l'utilisateur ou 0

        //construction
        $sql = "SELECT `id`, `".$this::PWD."` FROM `$this->table` WHERE `".$this::LOGIN."` = :identifiant";
        $param = [":identifiant" => $login];

        // dérouler
        $req = $this->runSql($sql, $param);

        // récupération
        $this->recoverReqSimple($req);

        if($this->is() && password_verify($pwd, $this->get($this::PWD))) return $this->id();
        else return 0;
    }


}