<?php
session_start();
require "." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();
$_SESSION['page'] = "tags";

$sr  = new Browser\Recherche();
$ls = new Browser\Liste();
?>

<?php ob_start() ;
    $sr->generatesearh();
    $ls->generateRecettes();
?>

<?php $content = ob_get_clean() ?>

<?php ob_start() ?>

    <link rel="stylesheet" href="CSS/index.css">

<?php $css = ob_get_clean() ?>

<?php ob_start() ?>

    <script src="JS/index.js"></script>

<?php $js = ob_get_clean() ?>

<?php Template::render($content, $css, $js) ?>