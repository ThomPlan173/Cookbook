<?php require "." . DIRECTORY_SEPARATOR .'class'.DIRECTORY_SEPARATOR.'Autoloader.php' ;
Autoloader::register();

?>

<?php ob_start() ?>

<div class="search">
    <div><h1>Recherche de recette :</h1></div>
    <input class="recherche" type="text" placeholder="Rechercher une recette">

</div>

<div class="search">
    <div><h1>Recette à partir d'un ingrédient :</h1></div>
    <input class="recherche" type="text" placeholder="Rechercher une recette avec un ingrédient">

</div>

<div class="search">
    <div><h1>Genre de recette :</h1></div>
    <input class="recherche" type="text" placeholder="Rechercher une recette">

</div>
<?php $content = ob_get_clean() ?>

<?php ob_start() ?>

<link rel="stylesheet" href="CSS/index.css" >

<?php $css = ob_get_clean() ?>

<?php ob_start() ?>

<script src="JS/index.js"></script>

<?php $js = ob_get_clean() ?>

<?php Template::render($content, $css, $js)?>
