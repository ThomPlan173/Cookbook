<?php
session_start();

$id = $_GET['idRecette'] ;

require ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();


$cb = new \cb\CoobookDB();
$data = $cb->getRecette($id);
$liste = $cb->getIngredients($id);
$tags = $cb->getTags($id);

$rc = new \Rec_Ig\Recette();
$_SESSION['page'] = $_SERVER['REQUEST_URI'];
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