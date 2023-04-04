<?php
session_start() ;


require ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();


$cb = new \cb\CoobookDB();
$data = $cb->getRecette();
?>

<?php ob_start() ?>

<div id="nom">
    <h1> <?= $data[0]->nomRecette ?></h1>
</div>
<div id="info">
    <img id="photo_tete" src="/Projet_Recettes/<?= $data[0]->imgRecette ?>">
    <div id="ingredient">
        <h3>Ingrédients :</h3>
        <ul>
            <li>
                </di>
                <div class="ingredient">
                    <img class="image_ingredient" src="/Projet_Recettes/images/tomate.jpg">
                    unité ingrédient
                </div>
            </li>
        </ul>
    </div>
</div>
<?= $data[0]->Description ?> <br />
<div id="flex">
    <div id="recette">
        <?= $data[0]->Preparation ?>
    </div>
</div>


<?php $content = ob_get_clean() ?>

<!----------------------->

<?php ob_start() ?>

<link rel="stylesheet" href="../CSS/recette.css" >

<?php $css = ob_get_clean() ?>

<!---------------------->

<?php ob_start() ?>

<script src="../JS/recette.js"></script>

<?php $js = ob_get_clean() ?>

<?php Template::render($content, $css, $js) ?>