<?php
session_start();

require "." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

?>

<?php ob_start() ?>
<form action="./index.php" method="post">
    <div class="search">
        <div>

            <h1>Recherche :</h1>
        </div>
        <input class="recherche" type="text" placeholder="Rechercher une recette" name="nom">
        <input type="submit" value="Rechercher">
    </div>
</form>


<fieldset>
    <legend>Type de recherche:</legend>

    <div>
      <input type="radio" id="huey" name="drone" value="huey"
             checked>
      <label for="huey">Par nom</label>
    </div>

    <div>
      <input type="radio" id="dewey" name="drone" value="dewey">
      <label for="dewey">Par ingrédient</label>
    </div>

    <div>
      <input type="radio" id="louie" name="drone" value="louie">
      <label for="louie">Par tag</label>
    </div>
</fieldset>

<fieldset>
    <legend>Préférences de recherche:</legend>

    <div>
      <input type="radio" id="huey" name="drone" value="huey"
             checked>
      <label for="huey">Alphabétique ( A-Z )</label>
    </div>

    <div>
      <input type="radio" id="dewey" name="drone" value="dewey">
      <label for="dewey">Alphabétique inversée ( Z-A )</label>
    </div>

    
</fieldset>

<?php if (isset($_POST["nom"])) {
    $cb = new \cb\CoobookDB();
    $data = $cb->search($_POST["nom"]);
    if (!empty($data)) {
        foreach ($data as $d) {
            ?>
            <form method='get' action='page/edit/recette.php'>
                <div>
                    <input type='image' type="submit" id='photo_tete' src='<?=$d->imgRecette?>'>
                    <option value
                    <?=$d->nomRecette?> <br/>
                    <?=$d->Description?>
                </div>
            </form>
            <?php
        }
    }else{
        echo "Aucune recette trouvée...";
    }
}; ?>

<?php $content = ob_get_clean() ?>

<?php ob_start() ?>

<link rel="stylesheet" href="CSS/index.css">

<?php $css = ob_get_clean() ?>

<?php ob_start() ?>

<script src="JS/index.js"></script>

<?php $js = ob_get_clean() ?>

<?php Template::render($content, $css, $js) ?>