<?php
session_start();
require ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();


$cb = new \cb\CoobookDB();
$sr  = new Browser\Liste();
$d = new \Edit\Delete();
$ad = new \Edit\Add();

if (isset($_POST['submit'])) {

    $nom = $_POST['nom'];
    $img = "images/" . $_POST['image'];
    $description = $_POST['description'];
    $preparation = $_POST['preparation'];
    $response = $ad->verifRecette($nom,$img,$description,$preparation);
    if ($response['granted']){
        $result = $cb->addRecette($img,htmlspecialchars($nom,ENT_QUOTES),htmlspecialchars($description, ENT_QUOTES),htmlspecialchars($preparation, ENT_QUOTES));
        header("Location: "."/Projet_Recettes/index.php");
        exit() ;
    }
}



?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"><script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<?php $dataRit = $cb->getAllRIT() ; ?>

<?php ob_start() ;

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
    function recherche(){

                let n_ingredient = 0;
                for(let id of ingredient_select) {
                    if (rit.liste_de_ingredients != null) {
                        if (rit.liste_de_ingredients.indexOf(id) != -1) {

                            n_ingredient++;
                        }
                    }
                }
                if(n_ingredient == ingredient_select.length){
                    let n_tag = 0;
                    for(let id of tag_select) {
                        if(rit.liste_de_tags != null) {
                            if (rit.liste_de_tags.indexOf(id) != -1) {
                                n_tag++;
                            }
                        }
                    }

                    }

    }

</script>

<div id = "reste_page" >
    <?php

    if (!isset($response)) :
        $ad->generateformRecette();
    elseif (!$response['granted']) :
        echo "<div class='error'>" ."Empty !"."</div>" ;
        $ad->generateformRecette($response['error']);
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

