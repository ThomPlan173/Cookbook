<?php
session_start();
require ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();


$cb = new \cb\CoobookDB();
$sr  = new Browser\Liste();

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

    let ingredient_select = [];
    let tag_select = [];
    let rit_select = vardataRit;

    let testadd = false;

    function removeAllChild(parent) {
        while (parent.firstChild) {
            parent.removeChild(parent.firstChild);
        }
    }
</script>

<script src="../JS/edit_add.js"></script>

<script>

    function add_true(){
        testadd = true;
    }

    function add_ingredient(){
        let form = document.createElement("form");
        form.method = "post";
        form.action = "EditIngr/addIngr.php";

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

<link rel="stylesheet" href="../CSS/add.css">

<?php $css = ob_get_clean() ?>

<?php ob_start() ?>

<script></script>

<?php $js = ob_get_clean() ?>

<?php Template::render($content, $css, $js) ?>

