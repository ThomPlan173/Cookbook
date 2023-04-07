<?php  
$_SESSION['page']="tags";

require "..." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

?>

<?php ob_start() ?>


<?php
$cb = new \cb\CoobookDB();
$data = $cb->getTags();
if (!empty($data)) {
    foreach ($data as $d) {

        ?>
            <div>
                <?=$d->nomTag?>, <br/>
            </div>

        <?php
    }
}
?>

<?php $content = ob_get_clean() ?>

<?php ob_start() ?>

    <link rel="stylesheet" href="/Projet_Recettes/CSS/index.css">

<?php $css = ob_get_clean() ?>

<?php ob_start() ?>

    <script src="/Projet_Recettes/JS/index.js"></script>

<?php $js = ob_get_clean() ?>

<?php Template::render($content, $css, $js) ?>