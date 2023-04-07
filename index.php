<?php
session_start();

require "." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

?>

<?php ob_start() ?>
<form action="./index.php" method="post">
    <div class="search">
        <div>

            <h1>Recherche de recette :</h1>
        </div>
        <input class="recherche" type="text" placeholder="Rechercher une recette" name="nom">
        <input type="submit" value="Rechercher">
    </div>
</form>


<div class="search">
    <div>
        <h1>Recette à partir d'un ingrédient :</h1>
    </div>
    <input class="recherche" type="text" placeholder="Rechercher une recette avec un ingrédient">
    <input type="button" value="Rechercher">
</div>

<div class="search">
    <div>
        <h1>Recherche par tag :</h1>
    </div>
    <input class="recherche" type="text" placeholder="Rechercher un tag">
    <input type="button" value="Rechercher">
</div>

<?php if (isset($_POST["nom"])) {
    $cb = new \cb\CoobookDB();
    $data = $cb->search($_POST["nom"]);
    foreach ($data as $d) {
       echo  "<div><img id='photo_tete' src='/Projet_Recettes/$d->imgRecette' >";
       echo "-" . $d->nomRecette . "<br/>";
       echo "<input type='button' value='Détails de la recette'></div>";
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