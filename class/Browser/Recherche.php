<?php

namespace Browser;

class Recherche
{
    function generatesearh(): void{ ?>
        <form action="./liste_recettes.php" method="post">
        <fieldset id="type_search">
            <legend>Type de recherche:</legend>

            <?php
            $a = "checked";
            $b = "";
            $c = "";
            if (isset($_POST["method"])) {
                if ($_POST["method"] == "nomIngredient") {
                    $a = "";
                    $b = "checked";
                    $c = "";
                }
                if ($_POST["method"] == "nomTag") {
                    $a = "";
                    $b = "";
                    $c = "checked";
                }
            }

            ?>

            <div>
                <input type="radio" id="type" name="method" value="nomRecette" <?= $a ?>>
                <label for="nom">Par nom</label>
            </div>

            <div>
                <input type="radio" id="type" name="method" value="nomIngredient" <?= $b ?>>
                <label for="ingredient">Par ingrédient</label>
            </div>

            <div>
                <input type="radio" id="type" name="method" value="nomTag" <?= $c ?>>
                <label for="louie">Par tag</label>
            </div>

        </fieldset>

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
<?php
    }
}
?>
