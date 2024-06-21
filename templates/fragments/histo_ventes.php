<?php
// fragment : création de la liste des ventes
?>
<thead>
    <tr>
        <th class="fs12">Vendeur</th>
        <th class="fs12">Client</th>
        <th class="fs12">Produit</th>
        <th class="fs12">Date</th>
    </tr>
</thead>
<tbody>
<?php
foreach($liste as $id => $vente){
    $vendeur = $vente->getTarget("vendeur");
    $client = $vente->getTarget("client");
    $produit = $vente->getTarget("produit");
    ?>
    <tr class="histo">
        <td class="fs10"><?= $vendeur->getHTML("nom") ?></td>
        <td class="fs10"><?= $client->getHTML("nom") ?></td>
        <td class="fs10"><?= $produit->get("ref") ?></td>
        <td class="fs10"><?= $vente->get("date") ?></td>
        <td class="w200 tdPop fs10 mrlauto txt-center d-none flex j-between a-center gap16"><div><?= $produit->get("design") ?><br> s/n: <?= $vente->getHTML("sn") ?></div><button class="tdClose btnPad">✖</button></td>
    </tr>
    <?php
}
?>
</tbody>
