<?php
namespace Browser;

class Recherche
{
    function generatesearch($cb): void{ ?>

        <div id="filtres">
            <div id="filtre_ingredients">
                <form>
                    <input id="search_ingredient" type="text" placeholder="Quels ingerdients" >

                    <div class="checkbox_ingredient">
                        <?php $data = $cb->getAllIngredients();
                         if (!empty($data)) {
                             foreach ($data as $d) {
                                ?>

                                 <input type="checkbox" name="<?= $d->nomIngredient?>">
                                 <label for="<?= $d->nomIngredient?>"><?= $d->nomIngredient?></label><br>

                             <?php }
                         }?>
                    </div>

                </form>

            </div>
            <div id="filtre_tags">
                <form>
                    <input id="search_tag" type="text" placeholder="Quels tags" >

                    <div class="checkbox_tag">
                        <?php $data = $cb->getAllTags("");
                         if (!empty($data)) {
                             foreach ($data as $d) {
                                ?>

                                 <input type="checkbox" name="<?= $d->nomTag?>">
                                 <label for="<?= $d->nomTag?>"><?= $d->nomTag?></label><br>

                             <?php }
                         } ?>
                    </div>

                </form>

            </div>
        </div>
        <div id="reste_page">
            <form action="./liste_recettes.php" method="post">


            <div class="search">
                <div>
                    <h1>Recherche :</h1>
                </div>
                <?php if (isset($_POST["nom"])) {  ?>
                    <input class="recherche" type="text" placeholder="Rechercher une recette" name="nom" value="<?= $_POST["nom"] ?>">
                <?php } else { ?>
                    <input class="recherche" type="text" placeholder="Rechercher une recette" name="nom">
                <?php } ?>
                <button id="search_button" type="submit">Rechercher</button>

                <fieldset id="trie" type="submit">
                    <legend>Préférences de recherche:</legend>

                    <?php

                    $a = "checked";
                    $b = "";
                    if (isset($_POST["preference"])) {
                        if ($_POST["preference"] == "DESC") {
                            $a = "";
                            $b = "checked";
                        }
                    }
                    ?>
                    <div class="tri">
                        <input type="radio" id="huwey" name="preference" value="ASC" <?= $a ?>>
                        <label for="huey">Alphabétique ( A-Z )</label>
                    </div>
                    <div class="tri">
                        <input type="radio" id="dewey" name="preference" value="DESC" <?= $b ?>>
                        <label for="dewey">Alphabétique inversée ( Z-A )</label>
                    </div>



                </fieldset>
            </div>
        </form>
        </div>

<?php
    }
}
?>