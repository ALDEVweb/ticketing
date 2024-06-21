<?php

// fragment : construit le select de la demande

?>
<option value=''>Sélectionnez votre produit</option>
<?php
    foreach ($listAchat as $id => $vente) {
        $produit = $vente->getTarget("produit");
        $nomProduit = $produit->get("design");
        $idProd = $vente->get("produit");
        ?>
        <option value='<?= $idProd ?>'><?= $nomProduit ?></option>
        <?php
    }