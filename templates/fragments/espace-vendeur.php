<?php
// fragment html de l'espace vente
?>

<div class="mt40">
    <a href="afficher_client.php"><button id="client" class="btnPad">Créer un client</button></a>        

    <h5 class="fs18 mt40"></h5>
    <form class="encart mt40" action="afficher_form_vente.php" method="POST">
        <div class="w200 mrlauto">
            <label class='w100p block fs16' for='idProduit'>Sélectionner un produit :</label>
            <select class="w100p mt4" name='idProduit' id='idProduit'>
                <?php include "templates/fragments/select_produit_vente.php"; ?>
            </select>
            <?php
                if($noProd == 1){
                    echo "<p class='w200 mt4 fs12 red mrlauto'>Veuillez selectionner un produit</p>";
                }
            ?>
        </div>
        <div class="w200 mrlauto mt16 flex j-between a-center">
            <input class="fs14" type="submit" value="Enregistrer une vente">
        </div>
    </form>
</div>