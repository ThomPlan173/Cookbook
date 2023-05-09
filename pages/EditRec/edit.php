<?php
session_start();
require ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

$id = $_GET['idRecette'];
$cb = new \cb\CoobookDB();
$data = $cb->getRecette($id);
$liste = $cb->getIngredients($id);
$tags = $cb->getTags($id);
$sr  = new Browser\Liste();
$ed = new \Edit\Edit();

$_SESSION['id'] = $_GET['idRecette'];
$_SESSION['nom'] = $data[0]->nomRecette;
$_SESSION['description'] = $data[0]->Description;
$_SESSION['preparation'] = $data[0]->Preparation;
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

<script src="../../JS/edit_add.js"></script>

<script>

    function add_ingredient(){
        let form = document.createElement("form");
        form.method = "post";
        form.action = "../EditIngr/addIngr.php";

        let inputNom = document.createElement("input");
        inputNom.placeholder = "nom";
        inputNom.type = "text";
        inputNom.name = "nom";
        inputNom.autofocus = true ;

        let inputImg = document.createElement("input");
        inputImg.type = "file";
        inputImg.name = "image";
        inputImg.accept = "image/png, image/gif, image/jpeg";
        inputImg.autofocus = true ;

        let inputSubmit = document.createElement("input");
        inputSubmit.type = "submit";
        inputSubmit.name = "submit";
        inputSubmit.value = "Valider";

        let add_form_ingredient = document.getElementById("add_form_ingredient");
        form.appendChild(inputNom);
        form.appendChild(inputImg);
        form.appendChild(inputSubmit);
        add_form_ingredient.appendChild(form);

    }

    function add_tag(){
        let form = document.createElement("form");
        form.method = "post";

        let inputNom = document.createElement("input");
        inputNom.placeholder = "nom";
        inputNom.type = "text";
        inputNom.nom = "nom";
        inputNom.autofocus = true ;

        let inputSubmit = document.createElement("input");
        inputSubmit.type = "submit";
        inputSubmit.name = "submit";
        inputSubmit.value = "Valider";

        form.appendChild(inputNom);
        form.appendChild(inputImg);
        form.appendChild(inputSubmit);
        checkbox_tag.appendChild(form);

    }

    function edit_ingredient(id,nom,img){
        let form = document.createElement("form");
        form.method = "post";
        form.action = "../EditIngr/editIngr.php";

        let inputId = document.createElement("input");
        inputId.hidden = true;
        inputId.type = "text";
        inputId.name = "id";
        inputId.value = id;

        let inputNom = document.createElement("input");
        inputNom.placeholder = "nom";
        inputNom.type = "text";
        inputNom.name = "nom";
        inputNom.value = nom ;
        inputNom.autofocus = true ;

        let inputImg = document.createElement("input");
        inputImg.type = "file";
        inputImg.name = "image";
        inputImg.accept = "image/png, image/gif, image/jpeg";
        inputImg.autofocus = true ;

        let inputSubmit = document.createElement("input");
        inputSubmit.type = "submit";
        inputSubmit.name = "submit";
        inputSubmit.value = "Valider";

        let edit_form_ingredient = document.getElementById("ingr"+id);
        form.appendChild(inputNom);
        form.appendChild(inputImg);
        form.appendChild(inputId);
        form.appendChild(inputSubmit);
        edit_form_ingredient.appendChild(form);
    }
</script>

<div id="reste_page">
    <?php

    if (!isset($_SESSION['response'])) :
        $ed->generateformRecette($_SESSION['nom'], $_SESSION['description'], $_SESSION['preparation']);
    elseif (isset($_SESSION['response'])) :
        $response = $_SESSION['response'];
        if(!$response['granted'] || !isset($_SESSION['upload'])):
            $ed->generateformRecette($_SESSION['nom'], $_SESSION['description'], $_SESSION['preparation'],$response['error']);
        elseif($_SESSION['upload']=""):
            $ed->generateformRecette($_SESSION['nom'], $_SESSION['description'], $_SESSION['preparation'],$response['error']);
        endif;
    endif; ?>
</div>

<?php $content = ob_get_clean() ?>

<?php ob_start() ?>

<link rel="stylesheet" href="../../CSS/index.css">

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
        var j;
        for (j = 0; j < x.length; j++) {

           ingredient_select.push(id);
            x[j].checked = true;

        }
    }
</script>