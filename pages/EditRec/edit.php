<?php
session_start();
require ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

if (!isset($_SESSION['id'])) :
    $_SESSION['id'] = $_GET['idRecette'];
endif;
$cb = new \cb\CoobookDB();
$data = $cb->getRecette($_SESSION['id']);
$nom = $data[0]->nomRecette;
$desc = $data[0]->Description;
$prepa = $data[0]->Preparation;
$liste = $cb->getIngredients($_SESSION['id']);
$tags = $cb->getTags($_SESSION['id']);
$sr  = new Browser\Liste();
$ed = new \Edit\Edit();
$img = false;
$_SESSION['page'] = "http://localhost/Projet_Recettes/";
?>

<?php $dataRit = $cb->getAllRIT(); ?>

<?php ob_start();
$sr->generateliste($cb); ?>
<?php if (isset($_SESSION['errortext'])) {
?> <span class="errortext"><?php echo $_SESSION['errortext'] ?> </span> <?php
                                                                    }
                                                                        ?>

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
        let div = document.createElement("div");
        div.className = "form_ingredient";

        let form = document.createElement("form");
        form.method = "post";
        form.action = "../EditIngr/addIngr.php";
        form.enctype = "multipart/form-data";

        let inputNom = document.createElement("input");
        inputNom.className = "inputNom_ingr";
        inputNom.placeholder = "Nom de l'ingredient";
        inputNom.type = "text";
        inputNom.name = "nomIngr";
        inputNom.autofocus = true;

        let inputImg = document.createElement("input");
        inputImg.className = "inputImg_ingr";
        inputImg.type = "file";
        inputImg.name = "image";
        inputImg.accept = "image/png, image/gif, image/jpeg";
        inputImg.autofocus = true;

        let inputSubmit = document.createElement("input");
        inputSubmit.type = "submit";
        inputSubmit.name = "submit";
        inputSubmit.value = "Valider";
        inputSubmit.className = "bouton_ingredient";

        let add_form_ingredient = document.getElementById("add_form_ingredient");

        form.appendChild(inputNom);
        form.appendChild(inputImg);
        form.appendChild(inputSubmit);
        div.appendChild(form);
        add_form_ingredient.appendChild(div);

    }

    function add_tag(){
        let form = document.createElement("form");
        form.method = "post";
        form.action = "../EditTag/addTag.php";

        let inputNom = document.createElement("input");
        inputNom.className = "inputNom_tag";
        inputNom.placeholder = "Nom du tag";
        inputNom.type = "text";
        inputNom.name = "nomTag";
        inputNom.autofocus = true;

        let inputSubmit = document.createElement("input");
        inputSubmit.className = "bouton_tag";
        inputSubmit.type = "submit";
        inputSubmit.name = "submit";
        inputSubmit.value = "Valider";

        let add_form_tag = document.getElementById("add_form_tag");
        form.appendChild(inputNom);
        form.appendChild(inputSubmit);
        div.appendChild(form);
        add_form_tag.appendChild(div);

    }

    function edit_ingredient(id,nom){
        let form = document.createElement("form");
        form.method = "post";
        form.action = "../EditIngr/editIngr.php";
        form.enctype = "multipart/form-data";

        let inputId = document.createElement("input");
        inputId.hidden = true;
        inputId.type = "text";
        inputId.name = "idIngr";
        inputId.value = id;

        let inputNom = document.createElement("input");
        inputNom.className = "inputNom_ingr";
        inputNom.placeholder = "nom";
        inputNom.type = "text";
        inputNom.name = "nomIngr";
        inputNom.value = nom;
        inputNom.autofocus = true;

        let inputImg = document.createElement("input");
        inputImg.className = "inputImg_ingr";
        inputImg.type = "file";
        inputImg.name = "image";
        inputImg.accept = "image/png, image/gif, image/jpeg";
        inputImg.autofocus = true;

        let inputSubmit = document.createElement("input");
        inputSubmit.type = "submit";
        inputSubmit.name = "submit";
        inputSubmit.value = "Valider";
        inputSubmit.className = "bouton_ingredient"

        let edit_form_ingredient = document.getElementById("ingr" + id);
        form.appendChild(inputNom);
        form.appendChild(inputImg);
        form.appendChild(inputId);
        form.appendChild(inputSubmit);
        div.appendChild(form);
        edit_form_ingredient.appendChild(div);
    }
    function edit_tag(id,nom){
        let form = document.createElement("form");
        form.method = "post";
        form.action = "../EditTag/editTag.php";

        let inputId = document.createElement("input");
        inputId.hidden = true;
        inputId.type = "text";
        inputId.name = "idTag";
        inputId.value = id;

        let inputNom = document.createElement("input");
        inputNom.className = "inputNom_tag";
        inputNom.placeholder = "nom";
        inputNom.type = "text";
        inputNom.name = "nomTag";
        inputNom.autofocus = true;
        inputNom.value = nom;

        let inputSubmit = document.createElement("input");
        inputSubmit.className = "bouton_tag";
        inputSubmit.type = "submit";
        inputSubmit.name = "submit";
        inputSubmit.value = "Valider";

        let edit_form_tag = document.getElementById("tag" + id);
        form.appendChild(inputNom);
        form.appendChild(inputId);
        form.appendChild(inputSubmit);
        div.appendChild(form);
        edit_form_tag.appendChild(div);

    }
</script>

<div id="reste_page">
    <?php

    if (!isset($_SESSION['response'])) :
        $ed->generateformRecette($nom, $desc, $prepa);
    elseif (isset($_SESSION['response'])) :
        $response = $_SESSION['response'];
        if (!$response['granted']) :
            $ed->generateformRecette($_SESSION['nom'], $_SESSION['description'], $_SESSION['preparation'], $response['error']);
        elseif (!isset($_SESSION['upload'])) :
            $img = true;
            $ed->generateformRecette($_SESSION['nom'], $_SESSION['description'], $_SESSION['preparation'], $response['error'], $img);
        endif;
    endif; ?>
</div>

<?php $content = ob_get_clean() ?>

<?php ob_start() ?>

<link rel="stylesheet" href="../../CSS/add.css">

<?php $css = ob_get_clean() ?>

<?php ob_start() ?>

<script></script>

<?php $js = ob_get_clean() ?>

<?php Template::render($content, $css, $js) ?>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php foreach ($tags as $t) { ?>
            FunctionTags("<?= $t->nomTag ?>", "<?= $t->idTag ?>");
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