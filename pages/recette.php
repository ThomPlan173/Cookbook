<?php
session_start();
//On récupère en paramètre l'ID de la recette pour afficher les données correspondantes
$id = $_GET['idRecette'] ;
if(!isset($_SESSION)) {
    session_start();
}
$_SESSION['idRecette'] = $id; //passage en session pour bien garder l'ID de recette en mémoire

require ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

//on récupère les données correspondantes à la recette
$cb = new \cb\cookbookDB();
$data = $cb->getRecette($id);
$liste = $cb->getIngredients($id);
$tags = $cb->getTags($id);

$rc = new \Rec_Ig\Recette();
$_SESSION['page'] = $_SERVER['REQUEST_URI']; //garder la page en mémoire
?>

<?php ob_start() ;

$rc->generateRecette($data,$tags,$liste);

?>

<?php $content = ob_get_clean() ?>

<!----------------------->

<?php ob_start() ?>

<link rel="stylesheet" href="../CSS/recette.css">

<?php $css = ob_get_clean() ?>

<!---------------------->

<?php ob_start() ?>

<script src="/Projet_recettes/JS/recette.js"></script>

<?php $js = ob_get_clean() ?>

<?php Template::render($content, $css, $js) ?>