<?php

namespace Rec_Ig;

class Recette
{
function generateRecette($data,$tags,$liste): void{ ?>
    <div id="nom">
        <h1> <?= utf8_encode( $data[0]->nomRecette ) ?></h1>
    </div>

    <div id="info">

        <img id="photo_tete" src="/Projet_Recettes/<?= $data[0]->imgRecette ?>">

        <div id="ingredient">
                <span id="nbPersonne">
                    Cette recette est pour
                    <input type="number" id="personne" name="personne" max="20" min="1" value="1">
                    personnes
                </span>
            <h3>Ingrédients :</h3>

            <div id="liste_inrgredient">
                <?php foreach ($liste as $l) {
                    echo "<div class='ingredient'><img class='image_ingredient' src='/Projet_Recettes/" . $l->imgIngredient

                        . "'>" ?> <span class="quantite" value="<?=$l->quantite?>"><?=$l->quantite?></span> <?= $l->unite . " " .  $l->nomIngredient . "</div>";
                }
                ?>


            </div>
        </div>
    </div>
    <div id="flex">
        <div id="recette">

            <?= htmlspecialchars_decode($data[0]->Preparation) ?>
        </div>
    </div>



<?php
}
}
?>