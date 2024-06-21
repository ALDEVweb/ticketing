<?php

/*

Classe _model : modèle générique de gestion des objets // sans la gestion des champs par l'objet

Utilisation :

    * Ouverture bdd :
        bdd() : crée la chaine de connexion à la base de donnée si elle n'existe pas et la retourne

    * Méthodes protégées (utilisable dans les classes filles) :
        define() : protected - a implémenter dans la classe fille en utilisant addfield à l'interieur
        get_$field() : vérification directement dans get($field), si un get spé existe on lance cette méthode, sinon lance la méthode générique
        verify() : vérifie la cohérence d'un objet

    * Méthodes neutres :
        __construct($id) : chargement d'un nouvel objet via l'id en une seule fois
        is() : vérifie si l'objet est chargé ou non

    * Méthodes magiques :
        __get() : utilisé lorsque l'on fait $objet->attribut ($name sera donc à la place de "attribut")
        __set() : utilisé lorsque l'on fait $objet->attribut = valeur (attribut sera $name et valeur $value)

    * Getters :
        id() : récupère l'id de l'objet
        get($field) : récupère la valeur stocké dans le champ ciblé de l'objet
        getHTML($field) : retourne le champ formaté de façon à transformer les ballises html en texte
        getTarget($field) : récupère l'objet de la classe pointé par le champ

    * Setters :        
        set($field, $value) :  charge le champ d'un objet avec sa valeur
        loadFromTab($table) : charge un objet avec un tableau de donnée (récupéré par fetch)
    
    * Méthodes de synchronisation avec la bdd :
        advancedLoad($param) :  : charge de façon autonome l'objet courant
        load($id) : chargement de l'objet courant par l'id 
        insert() : insert un objet dans la base de donnée
        update() : met à jour un objet existant dans la base de donnée
        delete() : supprime un objet dans la base de donnée
        listAll($filtre, $tri, $limit) : récupère la liste de tout les objet de la table et si ils sont spécifié y inclus des condition de récupération et de triage

    * Méthodes permettant de gérer les champs (création d'un objet champ) :
        addfield() : permet d'ajouter un champ à l'objet courant en utilisant l'objet champs 
        getField(): récupère l'objet correspondant çà un champ
        getAllFields() : récupère tout les champs d'un objet

    * Sous méthodes :
        toTab() : récupère les champs et valeurs d'un objet et les transforme en tableau
        makeSet() : construit la partie SET d'une requete insert ou update    
        makeParam() : construit les parametre nécessaire à insert et update
        makeFilter($filter) : construit la requete à mettre derriere le WHERE
        makeParamFilter($filter) : construit le tableau de parametre en fonction des filtres demandé
        makeTri($tri) : construit la requete à mettre derriere le ORDER BY
        makeFields() : consrtuit la liste des champs à mettre dans un SELECT (id + tt les champs d'une classe)
        runSql($sql, $param=NULL) : prépar et execute la requete sql
        recoverReqSimple($req) : récupère le résultat de la requete (lorsque le résultat attendu est unique)
        recoverReqMulti($req) : récupère le résultat de la requete (lorsque le résultat attendu est multiple)

*/

class _model {


    // Attributs
        protected $table = "";  // Table :
        protected $fields = []; // liste des champs de la classe
        protected $links = [];  // liste des liens entre les classes - ex: ["champ" => "class", ...]


    // stockage
        protected $id = 0;  // stockage de l'id
        protected $values = []; // valeur relatif aux champs de la classe - ex: ["champ" => valeur, ...]
        protected $targets = [];    // objet chargé des liens récupéré ["champ" => objetLié, ...]

        
    // Ouverture bdd :

        // création de la variable statique
        protected static $bdd;

        // ouverture
        static function bdd() {
            // Rôle : crée la chaine de connexion à la base de donnée si elle n'existe pas et la retourne
            // Paramètres : aucun
            // Retour : $bdd - chargé avec la chaine de connexion a la bdd (objet PDO)

            if (empty(static::$bdd)) {
                static::$bdd = new PDO("mysql:host=localhost;dbname=projets_tickets_alaugier;charset=UTF8", "alaugier", "9FPp96F9l?T");
            }
            return static::$bdd;
        }


    // Méthodes // 

        // Méthodes protégées (utilisable dans les classes filles) :
            /*
            protected function define() {
                // Rôle : protected - a implémenter dans la classe fille en utilisant addfield à l'interieur pour définir les champs de la classe
                // Paramètres : aucun
                // Retour : aucun
            }

            function verify(){
                // role : vérifie la cohérence d'un objet
                // parametre : aucun
                // retour : true si cohérent sinon false

                return true;
            }
            */


        // Neutres :

            function __construct($id = NULL){
                // cette fonction ce déclenche à chaque instanciation d'une classe, le parametre devra donc etre mis dans les parenthèse lors de cette instanciation
                // role : instancie un nouvel objet par l'id
                // parametre : $id - id de l'objet à instancier
                // retour: constructeur dc pas de retour

                //$this->define();

                if(!is_null($id)) $this->load($id);
            }

            function is(){
                // role : test si un objet est chargé
                // parametre : aucun
                // retour : true / false
        
                return !empty($this->id);
            }
    

        // Méthodes magiques :

            function __get($name){
                // role : utilisé lorsque l'on fait $objet->attribut ($name sera donc à la place de "attribut")
                // parametres : $name - le champs visé
                // retour : la valeur que l'on veut récupérer

                if($name === "id") return $this->id();
                else if(in_array($name, $this->fields)) return $this->get($name);

            }

            function __set($name, $value){
                // role : utilisé lorsque l'on fait $objet->attribut = valeur (attribut sera $name et valeur $value)
                // parametre : $name - champs que l'on souhaite charger
                //             $value - valeur à charger dans le champ
                // retour : aucun

                if(in_array($name, $this->fields)) $this->set($name, $value);
            }


        // Getters :
        
            function id(){
                // role : retourne l'id de l'objet courant
                // paramere : aucun
                // retour : $id - id de l'objet courant

                return $this->id;
            }

            function get($field){
                // role : récupère la valeur stocké dans le champs ciblé de l'objet courant
                // parametre : $field - le champs ciblé
                // return : la valeur stocké dans le champ ciblé ou chaine vide si

                // vérife si une méthode spécifique existe et retourne son résultat le cas échéant
                if(method_exists($this, "get_$field")){
                    $method = "get_$field";
                    return $this->$method; 
                } 

                if(isset($this->values[$field])) return $this->values[$field];
                else return "";
            }

            function getHTML($field){
                // role : retourne le champ formaté de façon à transformer les ballises html en texte
                // parametre : $field - le champ ciblé
                // retour : la valeur du champ tra nsformé

                return nl2br(htmlentities($this->get($field)));
            }

            function getTarget($field){
                // role : récupère l'objet de la classe pointé par le champ
                // parametre : $field - le champs pointant l'objet à récupérer
                // retour : si l'objet est déjà chargé, on retourne l'objet chargé 
                //          sinon, si le champ n'est pas un lien, retourne un nouvel objet de la class model
                //                 si le champ est un lien, retourne un objet de la class en question non chargé ou vierge si la cible est vide

                // si l'objet n'est pas déjà chargé
                if(!isset($this->targets[$field])){
                    // si le champ est un lien
                    if(isset($this->links[$field])){ 
                        $class = $this->links[$field];
                        $this->targets[$field] = new $class($this->get($field));
                    }else{
                        // sinon
                        $this->targets[$field] = new _model();
                    }
                }

                // retour
                return $this->targets[$field];

            }


        // Setters :

            function set($field, $value){
                // role : charge le champ d'un objet avec sa valeur
                // parametre : $field - champ à remplir
                //             $value - valeur à enregistrer dans le champ
                // retour : true / false
        
                // vérifie l'existence du champ ciblé
                if(isset($this->fields[$field])) $this->values[$field] = $value;
                else return false;
        
                // retour
                return true;
            }

            function loadFromTab($table){
                // Role : initialise un objet avec un tableau de donnée (récupéré par fetch)
                // paramètre : $table - le tableau de donnée récupéré
                // retour : true si ok / false sinon
        
                // si $table est vide je retourne false
                if(empty($table)) return false;
        
                // si j'ai un id dans le tableau, je le charge dans l'objet courant
                if(isset($table["id"])) $this->id = $table["id"];
        
                // pour chaque champ du tableau si il y a une valeur, je le charge dans le champ de l'objet courant
                foreach($this->fields as $field){
                    if(isset($table[$field])) $this->values[$field] = $table[$field];
                }
        
                // retour    
                return true;
            }


        // Méthodes de synchronisation avec la bdd :   
        
            function advancedLoad($param){
                // role : charge de façon autonome l'objet courant
                // parametre : $param - si c'est un id : charge l'objet à partir de l'id
                //                    - si c'est un tableau, charge l'objet courant avec les champs=>valeur du tableau
                //                    - si c'est un objet, charge l'objet courant avec cet objet
                // retour : true / false si ça a fonctionné
                
                // on test le parametre
                if(is_numeric($param)) $this->load($param);
                else if(is_array($param)) $this->loadFromTab($param);
                else if($param instanceof _model) $this->loadFromTab($param->toTab());

                return $this->is();
            }

            function load($id){
            // role : chargement de l'objet courant par l'id
            // parametre : $id - id de l'objet à récupérer
            // retour : true si ok / false sinon
        
                // construction
                $sql = "SELECT ". $this->makeFields() . " FROM `$this->table` WHERE `id` = :id";
                $param = [":id" => $id];
        
                // préparation/execution
                $req = $this->runSql($sql, $param);
        
                // récupération / retour
                return $this->recoverReqSimple($req);
            }

            function insert(){
                // role : insert un objet dans la base de donnée
                // parametres : aucun
                // retour : true false

                // construction
                $sql = "INSERT INTO `$this->table` SET " . $this->makeSet();
                $param = $this->makeParam();

                // préparation/éxécution
                $this->runSql($sql, $param);

                //retour
                return true;
            }

            function update(){
                // role : met à jour un objet existant dans la base de donnée
                // parametres : aucun
                // retour : true false

                // construction
                $sql = "UPDATE `$this->table` SET " . $this->makeSet() . " WHERE `id` = :id";
                $param = $this->makeParam();
                $param[":id"] = $this->id;

                // préparation/éxécution
                $this->runSql($sql, $param);

                //retour
                return true;
            }

            function delete(){
                // role : supprime un objet dans la base de donnée
                // parametres : aucun
                // retour : true false

                // construction
                $sql = "DELETE FROM `$this->table` WHERE `id` = :id";
                $param = [":id" => $this->id];

                // préparation/récupération
                $this->runSql($sql, $param);

                // retour
                return true;
            }

            function listAll($filter = [], $tri = [], $limit = NULL){
                // role : récupère la liste de tout les objet de la table et si ils sont spécifié y inclus des condition de récupération et de triage
                // parametres : $filter - tableau indexé par le champ ex ["champnom" => "valeurnom", etc..]
                //              $ tri - tableau simple avec - ou + pour asc desc et le champ qui sert de tri - ex ["-nom", etc..]
                //              $limit - nbre entier qui fixe la limite à récupérer
                // retour : un tableau d'objet indexé par l'id

                // construction
                $sql = "SELECT `id` " . $this->makeFields() . " FROM `$this->table`";
                $param = [];
                if(!empty($filter)){
                    $sql .= " WHERE " . $this->makeFilter($filter);
                    $param = $this->makeParamFilter($filter);
                }
                if(!empty($tri)) $sql .= " ORDER BY " . $this->makeTri($tri);
                if(!is_null($limit)) $sql .= " LIMIT $limit";

                // préparation/éxecution
                $req = $this->runSql($sql, $param);

                // récupération/retour
                return $this->recoverReqMulti($req);
            }


        // Méthodes permettant de gérer les champs (création d'un objet champ) :
            /*
            protected function addField($name, $type = NULL, $libelle = NULL, $link = NULL){
                // permet d'ajouter un champ à l'objet courant en utilisant l'objet champs 
                // parametres : $name - Nom du champ
                //              $type - facultatif - type de champ (TXT-DATE-LINK)
                //              $libelle - facultatif - libellé du champ
                //              $link - facultatif - objet pointé par le champ

                $this->fields[$name] = new _field($this, $name, $type, $libelle, $link);
            }
            
            function getField($field){
                // role : récupère l'objet correspondant à un champ
                // parametre : $field - le champ recherché
                // retour : l'objet champ si existe sinon un objet champ vierge avec un nom _
                
                if(isset($this->fields[$field])) return $this->fields[$field];
                else return new _field($this, "_");
            }
            
            function getAllFields(){
                // role : récupère tout les champs d'un objet
                // parametres : aucun
                // retour : un tableau simple des champs de l'objet

                return $this->fields;
            }
            */

        // Sous méthodes :

            function toTab(){
                // Role : récupèreles champs et valeurs d'un objet et les transforme en tableau
                // parametres : aucun
                // retour : tableau de valeur indexé par le nom du champs

                // initialisation du tableau
                $tab = [];
                // pour chaque champ 
                foreach($this->fields as $field){
                    // récupération de la valeur qu'on rajoute à l'indexe champ du tableau
                    $tab[$field] = $this->values[$field];
                }
                // retour du tableau
                return $tab;
            }

            function makeSet(){
                // role : construit la partie SET d'une requete insert ou update
                // parametre : aucun
                // retour : une chaine de caractère chargé avec la requete construite

                // construction d'un tableau construit avec le nom du champ = :nomduchamp, pour chaque champ
                $tab = [];
                foreach($this->fields as $field){
                    $tab[] = "`$field` = :$field";
                }
                // transformation du tableau en chaine caractère avec chaque element du tab séparé par ", " et retour
                return implode(", ", $tab);
            }

            function makeParam(){
                // role : construit les parametre nécessaire à insert et update
                // parametre : aucun
                // retour : un tableau indexé par le parametre - ex : [":nomchamp" => valeurchamp]

                // pour chaque champ, construction du tableau 
                $tab = [];
                foreach($this->fields as $field){
                    // si le champ à une valeur stocker, je la charge
                    if(isset($this->values[$field])) $tab[":$field"] = $this->values[$field];
                    // sinon je charge vide
                    else $tab[":$field"] = NULL;
                }

                // retour
                return $tab;
            }
            
            function makeFilter($filters){
                // role : construit la requete à mettre derriere le WHERE
                // parametre : $filter - un tableau indexé par le champ à filtrer - ex ["nomChamp" => "valeurChamp", etc...]
                // retour : la requete sous forme de chaine de caratctere - ex "`nomchamp` = :nomchamp, etc..."

                $tab = [];
                foreach($filters as $filter){
                    $tab[] = "`$filter` = :$filter";
                }

                return implode(", ", $tab);
            }

            function makeParamFilter($filters){
                // role : construit le tableau de parametre en fonction des filtres demandé
                // role : $filter - un tableau indexé par le champ à filtrer - ex ["nomChamp" => "valeurChamp", etc...]
                // retour : un tableau indexé par le champ - ex [":param" => "valeurParam", etc...]

                $tab = [];
                foreach($filters as $filter => $value){
                    $tab[":$filter"] = $value;
                }

                return $tab;
            }

            function makeTri($tris){
                // role : construit la requete à mettre derriere le ORDER BY
                // parametre : $tri - un tableau simple avec le champ et l'ordre - ex ["-nomChamp", etc]
                // retour : la requete sous forme de chaine de caratctere

                $tab = [];

                foreach($tris as $tri){
                    // récupère la direction +/- qui est sur le premier carac
                    $dir = substr($tri, 0, 1);
                    
                    if($dir === "-"){
                        // si dir = - on fixe tri descendant
                        $order = "DESC";
                        // récupère le champ qui sert de tri qui commence au 2e caractere
                        $field = substr($tri, 1);
                    }else if($dir === "+"){
                        // si dir = + on fixe tri ascendant
                        $order = "ASC";
                        // récupère le champ qui sert de tri qui commence au 2e caractere
                        $field = substr($tri, 1);
                    }else{
                        // si ce n'est ni + ni - c'est qu'il n'est pas spécifié, on fixe ascebndant par défaut
                        $order = "ASC";
                        // et on récupère le champ qui commence du coup au premier caractère
                        $field = $tri;
                    } 
                    $tab[] = "`$field` $order";
                }

                // retour de la requete
                return implode(", ", $tab);

            }

            function makeFields(){
                // role : construit la liste des champs à récupérer
                // parametre : aucun
                // retour : $select - une chaine de caractère avec la liste des champs
        
                // initialisation du tableau
                $array = ["`id`"];
                
                // chargement du tableau avec les champs de l'objet
                foreach($this->fields as $field) $array[] = "`$field`";
                    
                // retour
                return implode(", ", $array);

            }
        
            function runSql($sql, $param=[]){
            // role : construit la préparation, l'executionde la requete sql
            // parametre : $sql - la requete elle meme
            //             $param - les parametre de la requete
            // retour : retourne la requete construite ou false si echec
        
                // préparation
                $bdd = static::bdd();
                $req = $bdd->prepare($sql);
        
                // exécution
                if(!$req->execute($param)){
                    // erreur de syntaxe : code de debug
                    echo "Echec sql : $sql";
                    print_r($param);
                    return false;
                }
                    
                // retour
                return $req;
            }
        
            function recoverReqSimple($req){
                // Role : récupère le résultat de la requete lorsqu'il est unique et le charge
                // parametre : $req - la requete en question
                // retour : true / false
                $result = $req->fetch(PDO::FETCH_ASSOC);
        
                // traitement
                // si vide : retourne false
                if(empty($result)) return false;
        
                //sinon : charge l'objet avec le résultat
                $this->loadFromTab($result);
        
                // retour
                return true;
            }
        
            function recoverReqMulti($req){
                // Role : récupère le résultat de la requete lorsqu'il est multiple
                // parametre : $req - la requete en question
                // retour : tableau d'objet indexé par l'id
        
                // récupération
                $array = [];
                while($result = $req->fetch(PDO::FETCH_ASSOC)){
                    $class = get_class($this);
                    $objet = new $class();
                    $objet->loadFromTab($result);
                    $array[$objet->id()] = $objet;
                }
        
                // retour
                return $array;
            }
}