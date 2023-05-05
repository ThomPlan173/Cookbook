<?php
session_start();
require ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

$id = $_GET['idRecette'];
$cb = new \cb\CoobookDB();
$data = $cb->getRecette($id);
$liste = $cb->getIngredients($id);
$tags = $cb->getTags($id);
$sr  = new Browser\Liste();
$ed = new \Edit\Edit();


if (isset($_POST['submit'])) {


    $nom = $_POST['nom'];
    $img = "images/" . $_POST['image'];
    $description = $_POST['description'];
    $preparation = $_POST['preparation'];
    $response = $ed->verif($nom, $img, $description, $preparation);
    if ($response['granted']) {
        $result = $cb->updateRecette($id, $img, htmlspecialchars($nom, ENT_QUOTES), htmlspecialchars($description, ENT_QUOTES), htmlspecialchars($preparation, ENT_QUOTES));
        header("Location: " . "/Projet_Recettes/index.php");
        exit();
    }
}
?>

<?php $dataRit = $cb->getAllRIT(); ?>

<?php ob_start();

$sr->generateliste($cb); ?>

<script>
    let vardataRit = <?php echo json_encode($dataRit); ?>;

    let input_ingr = document.getElementById("search_ingredient");
    let input_tag = document.getElementById("search_tag");
    let input_rit = document.getElementById("search_rit");

    let checkbox_ingr = document.getElementById("checkbox_ingredient");
    let checkbox_tag = document.getElementById("checkbox_tag");
    let checkbox_rit = document.getElementById("liste_recette");

    let ingredient_select = [];
    let tag_select = [];
    let rit_select = vardataRit;

    function removeAllChild(parent) {
        while (parent.firstChild) {
            parent.removeChild(parent.firstChild);
        }
    }
</script>

<script src="../JS/edit_add.js"></script>

<script>
    function recherche(){
    }
</script>

<div id="reste_page">
    <?php

    if (!isset($response)) :
        $ed->generateformRecette($data[0]->nomRecette, $data[0]->imgRecette, $data[0]->Description, $data[0]->Preparation);
    elseif (!$response['granted']) :
        echo "<div class='error'>" . "Empty !" . "</div>";
        $ed->generateformRecette($response['error']);
    endif; ?>
</div>

<?php $content = ob_get_clean() ?>

<?php ob_start() ?>

<link rel="stylesheet" href="../CSS/index.css">

<?php $css = ob_get_clean() ?>

<?php ob_start() ?>

<script></script>

<?php $js = ob_get_clean() ?>

<?php Template::render($content, $css, $js) ?>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php foreach ($tags as $t) { ?>
            FunctionTags("<?= $t->nomTag ?>","<?= $t->idTag ?>");
        <?php  } ?>
        <?php foreach ($liste as $l) { ?>
            FunctionIngredients("<?= $l->nomIngredient ?>", "<?= $l->idIngredient ?>");
        <?php  } ?>
        console.log(tag_select);
    })

    function FunctionTags(tag, id) {
        var x = document.getElementsByName(tag);
        var i;
        for (i = 0; i < x.length; i++) {

            tag_select.push(id);
            x[i].checked = true;

        }
    }

    function FunctionIngredients(ingr, id) {
        var x = document.getElementsByName(ingr);
        var i;
        for (i = 0; i < x.length; i++) {

           ingredient_select.push(id);
            x[i].checked = true;

        }
    }
</script>