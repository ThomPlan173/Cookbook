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

<script src="../JS/index.js"></script>

<script>
    function recherche() {

        removeAllChild(checkbox_rit);
        let n_ingredient = 0;
        for (let id of ingredient_select) {
            if (rit.liste_de_ingredients != null) {
                if (rit.liste_de_ingredients.indexOf(id) != -1) {

                    n_ingredient++;
                }
            }
        }
        if (n_ingredient == ingredient_select.length) {
            let n_tag = 0;
            for (let id of tag_select) {
                if (rit.liste_de_tags != null) {
                    if (rit.liste_de_tags.indexOf(id) != -1) {
                        n_tag++;
                    }
                }
            }

        }

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
<?php var_dump($tags); ?>
<?php $js = ob_get_clean() ?>

<?php Template::render($content, $css, $js) ?>

<?php foreach ($tags as $t) {
    echo $t->nomTag; ?>
    <script>
        document.getElementsByName("<?= $t->nomTag; ?>").checked = true;
    </script>
<?php  } ?>