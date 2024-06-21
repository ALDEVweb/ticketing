<?php 

// fragment constructeur de la liste des message d'un ticket

foreach($listeMsg as $id => $msg){
    $auteur = $msg->getTarget("auteur");
    ?>
        <div class="mt8">
            <p class="mt4"><?= $auteur->getHTML("prenom") ?> - <?= $msg->get("date") ?></p>
            <p class="mt4"><?= $msg->getHTML("contenu") ?></p>
        </div>
    <?php
}