<?php
session_start();
require "." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();
$_SESSION['page'] = "ingredients";

?>

<?php ob_start() ?>
<form action="./index.php" method="post">
    <fieldset id="type_search">
        <legend>Type de recherche:</legend>

        <?php
        $a = "checked";
        $b = "";
        $c = "";
        if(isset($_POST["method"])){
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

<div id="liste_recette">
    <?php if (isset($_POST["nom"]) && isset($_POST["method"]) && isset($_POST["preference"])) {
        $cb = new \cb\CoobookDB();
        $data = $cb->search($_POST["nom"], $_POST["method"], $_POST["preference"]);


        switch ($_POST["method"]) {
            case 'nomRecette':
                echo "<div class='blabla'> Recettes similaires à " . "\"" . $_POST["nom"] . "\" :" . "</div>";
                break;
            case 'nomIngredient':
                echo "<div class='blabla'> Recettes contenant " . "\"" . $_POST["nom"] . "\" :" . "</div>";
                break;
            case 'nomTag':
                echo "<div class='blabla'> Recettes contenant le tag " . "\"" . $_POST["nom"] . "\" :" . "</div>";
                break;
        }

        if (!empty($data)) {
            foreach ($data as $d) {

    ?>
                <form method='get' action="pages/recette.php">
                    <div class="recette">
                        <button class="bouton_image_recette" type="submit" id='photo_tete' name="msg" value='<?= $d->idRecette ?>'>
                            <img class="image_recette" src="<?= $d->imgRecette ?>">
                        </button>
                        <div>
                            <h3><?= utf8_encode($d->nomRecette) ?> :</h3>
                            <?= utf8_encode($d->Description) ?>
                        </div>
                    </div>
                </form>

    <?php
            }
        } else {
            echo "Aucune recette trouvée...";
        }
    }; ?>
</div>
<?php $content = ob_get_clean() ?>

<?php ob_start() ?>

<link rel="stylesheet" href="CSS/index.css">

<?php $css = ob_get_clean() ?>

<?php ob_start() ?>

<script src="JS/index.js"></script>

<?php $js = ob_get_clean() ?>

<?php Template::render($content, $css, $js) ?>