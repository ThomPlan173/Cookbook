<?php require_once __DIR__.DIRECTORY_SEPARATOR."/Template/Template.php";?>

<?php ob_start() ?>

<div id="content2">
    <h1>Hello world !!</h1>
</div>

<?php $content = ob_get_clean() ?>

<?php ob_start() ?>

<link rel="stylesheet" href="css/index.css" >

<?php $css = ob_get_clean() ?>

<?php ob_start() ?>

<script src="JS/index.js"></script>

<?php $js = ob_get_clean() ?>

<?php Template::render($content, $css, $js)?>
