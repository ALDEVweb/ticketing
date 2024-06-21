<?php

// fragment : construit le select de la demande

?>
<option value=''>Sélection produit</option>
<?php
    foreach ($listproduit as $id => $produit) {
        ?>
        <option value='<?= $id ?>'><?= $produit->get("design") ?></option>
        <?php
    }