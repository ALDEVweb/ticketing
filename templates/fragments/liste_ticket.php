<?php
// $listeAttente : - (si espace tech) tout les tickets ouv/ec avec dernier msg= client 
//                 - (si espace client) tout les tickets ouv/ec avec dernier msg different client
//$listeRepondu : - (si espace tech)  tout les tickets ouv/ec avec dernier msg = client 
//                - (si espace client) tout les tickets ouv/ec avec dernier msg different client
?>


<h5 class="fs18">Tickets en attente de réponse </h5>

<ul class="mt16">
    <?php
    foreach($listeAttente as $id => $ticket){
        echo "<li class='mt8 fs14'>$id - ";
        if($espace === "technicien"){
            $client = $ticket->getTarget("client");
            $nomClient = $client->get("nom");
            echo "$nomClient - ";
        }
        $produit = $ticket->getTarget("produit");
        $refProduit = $produit->get("ref");
        $statut = $ticket->get("statut");
        $ouverture = $ticket->get("ouverture");
        echo "$refProduit - $statut - $ouverture - <a href='afficher_ticket.php?idTicket=$id'>⇛</li>";
    }
    ?>
</ul>
<h5 class="mt40 fs18">Tickets ouvert ou en cours :</h5>
<ul class="mt16">
    <?php
    foreach($listeRepondu as $id => $ticket){
        echo "<li class='mt8 fs14'>$id - ";
        if($espace === "technicien"){
            $client = $ticket->getTarget("client");
            $nomClient = $client->get("nom");
            echo "$nomClient - ";
        }
        $produit = $ticket->getTarget("produit");
        $refProduit = $produit->get("ref");
        $statut = $ticket->get("statut");
        $ouverture = $ticket->get("ouverture");
        echo "$refProduit - $statut - $ouverture - <a href='afficher_ticket.php?idTicket=$id'>⇛</a></li>";
    }
    ?>
</ul>
