<?php require_once __DIR__.DIRECTORY_SEPARATOR."/Template/Template.php";?>

<?php ob_start() ?>
<h1>Hello world !!</h1>
<?php $content = ob_get_clean() ?>

<?php ob_start() ?>
<?php $css = ob_get_clean() ?>

<?php ob_start() ?>

<script src="JS/index.js"></script>

<?php $js = ob_get_clean() ?>

<?php Template::render($content, $css, $js)?>
