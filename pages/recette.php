<?php
session_start();
$msg = $_GET['msg'] ;
$id = htmlspecialchars( utf8_encode($msg))  ;

require ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();


$cb = new \cb\CoobookDB();
$data = $cb->getRecette($id);
$liste = $cb->getIngredients($id);
$tags = $cb->getTags($id);

?>

<?php ob_start() ?>

<div id="nom">
    <h1> <?= utf8_encode( $data[0]->nomRecette ) ?></h1>
    <?php foreach ($tags as $t) {
        echo " - " . utf8_encode($t->nomTag) . "<br/>";
    } ?>
</div>
<div id="info">
    
    <img id="photo_tete" src="/Projet_Recettes/<?= $data[0]->imgRecette ?>">
    <div id="ingredient">
        <h3>Ingrédients :</h3>
        <ul>
            <?php foreach ($liste as $l) {
                echo "<li><div class='ingredient'><img class='image_ingredient' src='/Projet_Recettes/" . $l->imgIngredient

                    . "'>" . $l->quantite . $l->unite . " " .  $l->nomIngredient . "</div></li>";
            }
            ?>
        </ul>
    </div>
</div>
<?= utf8_encode($data[0]->Description) ?> <br />
<div id="flex">
    <div id="recette">

        <?= utf8_encode($data[0]->Preparation) ?>
    </div>
</div>


<?php $content = ob_get_clean() ?>

<!----------------------->

<?php ob_start() ?>

<link rel="stylesheet" href="../CSS/recette.css">

<?php $css = ob_get_clean() ?>

<!---------------------->

<?php ob_start() ?>

<script src="../JS/recette.js"></script>

<?php $js = ob_get_clean() ?>

<?php Template::render($content, $css, $js) ?>