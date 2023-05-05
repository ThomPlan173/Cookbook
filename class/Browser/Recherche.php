<?php

namespace Browser;

class Recherche
{
    function generatesearch($cb): void
    { ?>

        <div id="filtres">

            <div id="filtre_ingredients">
                <form>

                    <input id="search_ingredient" type="text" placeholder="Quels ingrédients" name="ingredient">

                    <div id="checkbox_ingredient">
                        <?php $dataIngr = $cb->getAllIngredients() ; ?>
                    </div>

                </form>
            </div>

            <div id="filtre_tags">
                <form>

                    <input id="search_tag" type="text" placeholder="Quels tags">

                    <div id="checkbox_tag">
                        <?php $dataTag = $cb->getAllTags() ; ?>
                    </div>

                </form>
            </div>

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
                    <label for="huey">Alph(A-Z)</label>
                </div>
                <div class="tri">
                    <input type="radio" id="dewey" name="preference" value="DESC" <?= $b ?>>
                    <label for="dewey">Alph inversée(Z-A)</label>
                </div>
            </fieldset>

        </div>

        <div id="reste_page">
            <form>
                <div class="search">
                    <div>
                        <h1>Recherche :</h1>
                    </div>

                    <input id="search_rit" type="text" placeholder="Rechercher une recette" name="nom">


                </div>
            </form>

            <div id="liste_recette">

            </div>
        </div>


        <script>
            var vardataIngr = <?php echo json_encode($dataIngr); ?>;
            var vardataTag = <?php echo json_encode($dataTag); ?>;


        </script>
<?php
    }
}
?>