<?php

namespace Rec_Ig;

class Recette
{
function generateRecette($data,$tags,$liste): void{ ?>
    <div id="nom">
        <h1> <?= utf8_encode( $data[0]->nomRecette ) ?></h1>
        <?php foreach ($tags as $t) {
            echo " - " . utf8_encode($t->nomTag) . "<br/>";
        } ?>
    </div>
    <div id="info">

        <img id="photo_tete" src="/Projet_Recettes/<?= $data[0]->imgRecette ?>">
        <span id="nbPersonne">
        Cette recette est pour
        <input type="number" id="personne" name="personne" max="20" min="1" value="1">

    </span>
        <div id="ingredient">
            <h3>Ingrédients :</h3>
            <ul>
                <?php foreach ($liste as $l) {
                    echo "<li><div class='ingredient'><img class='image_ingredient' src='/Projet_Recettes/" . $l->imgIngredient

                        . "'>" ?> <quantite><?=$l->quantite?></quantite> <?= $l->unite . " " .  $l->nomIngredient . "</div></li>";
                }
                ?>
            </ul>
        </div>
    </div>
    <div id="flex">
        <div id="recette">

            <?= utf8_encode($data[0]->Preparation) ?>
        </div>
    </div>



<?php
}
}
?>