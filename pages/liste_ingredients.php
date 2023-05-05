<?php
session_start();
$_SESSION['page']="ingredients";
require ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

?>

<?php ob_start() ?>


<?php
    $cb = new \cb\CoobookDB();
    $data = $cb->getIngredients();
    if (!empty($data)) {
        foreach ($data as $d) {

            ?>
            <form method='get' action="recette.php" >
                <div>
                    <button type="submit" id='photo_tete' name="msg" value='<?=$d->idIngredient?>'>
                        <img src="<?=$d->imgIngredient?>">
                    </button>
                    <?=$d->nomIngredient?> <br/>
                </div>
            </form>

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
