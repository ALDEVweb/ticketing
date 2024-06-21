<?php
// fragment : création de la liste des tickets
?>
<thead>
    <tr>
        <th class="fs12">Client</th>
        <th class="fs12">Produit</th>
        <th class="fs12">Statut</th>
        <th class="fs12">Ouverture</th>
    </tr>
</thead>
<tbody>
<?php
foreach($liste as $id => $ticket){
    $client = $ticket->getTarget("client");
    $produit = $ticket->getTarget("produit");
    ?>
    <tr class="histo">
        <td class="fs10"><?= $client->getHTML("nom") ?></td>
        <td class="fs10"><?= $produit->get("ref") ?></td>
        <td class="fs10"><?= $ticket->get("statut") ?></td>
        <td class="fs10"><?= $ticket->get("ouverture") ?></td>
        <td class="w200 tdPop fs10 mrlauto txt-center d-none flex j-between a-center gap16"><div><?= $produit->get("design") ?><br><?= $ticket->getHTML("demande") ?><br><a href="afficher_ticket.php?idTicket=<?= $id ?>">Détail ⇛</a>
        <?php
            if($ticket->get("fermeture") != ""){
                ?>
                <br> cloturé le <?= $ticket->get("fermeture") ?> par <? $ticket->get("par") ?>
                <?php
            }
        ?>
        </div><button class="tdClose btnPad">✖</button></td>
    </tr>
    <?php
}
?>
</tbody>