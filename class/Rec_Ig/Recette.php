<?php

namespace Rec_Ig;

class Recette
{
    function generateRecette($data, $tags, $liste): void
    { ?>

        <!-- Nom de la recette -->
        <div id="nom">
            <h1> <?= htmlspecialchars_decode($data[0]->nomRecette) ?></h1>
        </div>

        <div id="info">
            <!-- image -->
            <img id="photo_tete" src="/Projet_Recettes/<?= $data[0]->imgRecette ?>">
            <!-- Liste d'ingredients -->
            <div id="ingredient">
                <span id="nbPersonne">
                    Cette recette est pour
                    <input type="number" id="personne" name="personne" max="20" min="1" value="1">
                    personnes
                </span>
                <h3>Ingrédients :</h3>

                <div id="liste_ingredient">
                    <?php foreach ($liste as $l) {
                        echo "<div class='ingredient'><img class='image_ingredient' src='/Projet_Recettes/" . $l->imgIngredient

                            . "'>" ?> <span class="quantite" value="<?= $l->quantite ?>"><?= $l->quantite ?></span> <?= $l->unite . " " .  $l->nomIngredient . "</div>";
                                                                                                        }
                                                                                                            ?>


                </div>
            </div>
        </div>
        <div id="flex">
            <div id="recette">
                <?php $prep = str_replace("\n", "<br/>", $data[0]->Preparation); ?>

                <?= htmlspecialchars_decode($prep) ?>
            </div>
        </div>



<?php
    }
}
?>