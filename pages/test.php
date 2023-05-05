<?php
session_start();
require ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();


$cb = new \cb\CoobookDB();
$sr  = new Browser\Liste();

$d = new \Edit\Delete();



?>

<?php ob_start() ;
/*

if (isset($_POST["del"])) {
    $id = $_POST["del"];

    //$d->generateform($id);
}
*/
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

        removeAllChild(checkbox_rit);
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


<?php $content = ob_get_clean() ?>

<?php ob_start() ?>

<link rel="stylesheet" href="../CSS/index.css">

<?php $css = ob_get_clean() ?>

<?php ob_start() ?>

<script></script>

<?php $js = ob_get_clean() ?>

<?php Template::render($content, $css, $js) ?>

