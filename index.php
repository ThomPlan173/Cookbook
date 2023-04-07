<?php
session_start();

require "." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();
$_SESSION['page'] = "ingredient";
?>

<?php ob_start() ?>

<fieldset>
    <legend>Type de recherche:</legend>

    <div>
        <input type="radio" id="type" name="type" value="nom" checked>
        <label for="nom">Par nom</label>
    </div>

    <div>
        <input type="radio" id="type" name="type" value="ingrédient">
        <label for="ingredient">Par ingrédient</label>
    </div>

    <div>
        <input type="radio" id="type" name="type" value="tag">
        <label for="louie">Par tag</label>
    </div>
</fieldset>

<form action="./index.php" method="post">
    <div class="search">
        <div>
            <h1>Recherche :</h1>
        </div>
        <input class="recherche" type="text" placeholder="Rechercher une recette" name="nom">
        <button id="search_button" type="submit">Rechercher</button>
    </div>
</form>




<fieldset>
    <legend>Préférences de recherche:</legend>

    <div>
        <input type="radio" id="huey" name="drone" value="huey" checked>
        <label for="huey">Alphabétique ( A-Z )</label>
    </div>

    <div>
        <input type="radio" id="dewey" name="drone" value="dewey">
        <label for="dewey">Alphabétique inversée ( Z-A )</label>
    </div>


</fieldset>

<div id="liste_recette">
<?php if (isset($_POST["nom"])) {
    $cb = new \cb\CoobookDB();
    $data = $cb->search($_POST["nom"]);
    if (!empty($data)) {
        foreach ($data as $d) {
           
            ?>
            <form method='get' action="pages/recette.php" >
                <div class="recette">
                    <button class="bouton_image_recette" type="submit" id='photo_tete' name="msg" value='<?=$d->idRecette?>'>
                        <img class="image_recette" src="<?=$d->imgRecette?>">
                    </button>
                    <div>
                        <h3><?=$d->nomRecette?> :</h3>
                        <?=$d->Description?>
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

