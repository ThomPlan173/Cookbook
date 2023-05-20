<?php

#----------------------------------------------ALEXANDRE___DEBUT------------------------------------------------------------

//page contenant le formualaire d'ajout d'une recette avec la possiblité d'ajouter/modifier les ingrédients/tags

session_start();
require ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();


$cb = new \cb\cookbookDB();
$sr  = new Browser\Liste();
$ad = new \Edit\Add();
$img = false;
$_SESSION['page'] = "http://localhost/Projet_Recettes/"; // enregistre la page index
?>

<?php $dataRit = $cb->getAllRIT() ; ?>

<?php ob_start() ; //génère un message d'erreur si il y a une erreur d'ajout/edition d'un tag/ingrédient
$sr->generateliste($cb); ?>
<?php if(isset($_SESSION['errortext'])){
?>

    <script>
        let error = document.getElementById("filtres");

        let span = document.createElement("span");
        span.className = 'errortext';
        span.innerHTML = <?php echo $_SESSION['errortext']?>;

        error.appendChild(span);
    </script>

   <?php
}

#----------------------------------------------ALEXANDRE___FIN------------------------------------------------------------
?>



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

    function removeAllChild(parent) {
        while (parent.firstChild) {
            parent.removeChild(parent.firstChild);
        }
    }
</script>

<script src="../../JS/add.js"></script>

<script>

/*#----------------------------------------------ALEXANDRE___DEBUT------------------------------------------------------------*/

    function add_ingredient(){ /* permet de générer un form qui permet d'ajouter un ingrédient  */
        let div = document.createElement("div");
        div.className = "form_ingredient";

        let form = document.createElement("form");
        form.method = "post";
        form.action = "../EditIngr/addIngr.php";
        form.enctype="multipart/form-data";

        let inputNom = document.createElement("input");
        inputNom.className = "inputNom_ingr";
        inputNom.placeholder = "Nom de l'ingredient";
        inputNom.type = "text";
        inputNom.name = "nomIngr";
        inputNom.autofocus = true ;

        let inputImg = document.createElement("input");
        inputImg.className = "inputImg_ingr";
        inputImg.type = "file";
        inputImg.name = "image";
        inputImg.accept = "image/png, image/gif, image/jpeg";
        inputImg.autofocus = true ;

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

    function add_tag(){/* permet de générer un form qui permet d'ajouter un tag  */
        let div = document.createElement("div");
        div.className = "form_tag";

        let form = document.createElement("form");
        form.method = "post";
        form.action = "../EditTag/addTag.php";

        let inputNom = document.createElement("input");
        inputNom.className = "inputNom_tag";
        inputNom.placeholder = "Nom du tag";
        inputNom.type = "text";
        inputNom.name = "nomTag";
        inputNom.autofocus = true ;

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

    function edit_ingredient(id,nom){/* permet de générer un form qui permet de modifier un ingrédient  */
        let div = document.createElement("div");
        div.className = "form_ingredient";

        let form = document.createElement("form");
        form.method = "post";
        form.action = "../EditIngr/editIngr.php";
        form.enctype="multipart/form-data";

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
        inputNom.value = nom ;
        inputNom.autofocus = true ;

        let inputImg = document.createElement("input");
        inputImg.className = "inputImg_ingr";
        inputImg.type = "file";
        inputImg.name = "image";
        inputImg.accept = "image/png, image/gif, image/jpeg";
        inputImg.autofocus = true ;

        let inputSubmit = document.createElement("input");
        inputSubmit.type = "submit";
        inputSubmit.name = "submit";
        inputSubmit.value = "Valider";
        inputSubmit.className = "bouton_ingredient"

        let edit_form_ingredient = document.getElementById("ingr"+id);
        form.appendChild(inputNom);
        form.appendChild(inputImg);
        form.appendChild(inputId);
        form.appendChild(inputSubmit);
        div.appendChild(form);
        edit_form_ingredient.appendChild(div);
    }

    function edit_tag(id,nom){/* permet de générer un form qui permet de modifier un tag  */
        let div = document.createElement("div");
        div.className = "form_tag";

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
        inputNom.autofocus = true ;
        inputNom.value = nom;

        let inputSubmit = document.createElement("input");
        inputSubmit.className = "bouton_tag";
        inputSubmit.type = "submit";
        inputSubmit.name = "submit";
        inputSubmit.value = "Valider";

        let edit_form_tag = document.getElementById("tag"+id);
        form.appendChild(inputNom);
        form.appendChild(inputId);
        form.appendChild(inputSubmit);
        div.appendChild(form);
        edit_form_tag.appendChild(div);

    }

</script>

<div id = "reste_page" >
    <?php

    if (!isset($_SESSION['response'])) : // si il n'y a pas de réponse génère le formulaire sans param donc sans données prédéfinit
        $ad->generateformRecette();
    elseif (isset($_SESSION['response'])) : // si il y a une réponse, sauvegarde la réponse et recrée
        $response = $_SESSION['response']; // un formualire si il y a eu une erreur avec les erreurs et les données entrées précédemment
        if(!$response['granted']):
        $ad->generateformRecette($_SESSION['nom'], $_SESSION['description'], $_SESSION['preparation'],$response['error']);
        elseif(!isset($_SESSION['upload'])): // si il s'agit d'un problème lié au fichier à upload renvoie le form avec l'erreur de fichier et les données
            $img = true;
            $ad->generateformRecette($_SESSION['nom'], $_SESSION['description'], $_SESSION['preparation'],$response['error'], $img);
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
    function CheckedTags(tag, id){ /* permet de checked un tag qui a été checked avant le submit */
            let i;
            let box = document.getElementsByName(tag); // récupère le tag
            let hide_input = document.getElementById("hideTag"+id); // récupère sont hide_input et met sa valeur à true pour enregistrer dans le POST de add que le tag soit checked
            hide_input.value = "true";
            for(i = 0;i<box.length;i++){     // checked la box
                box[i].checked = true;
            }
    }

    <?php if(isset($_SESSION["tagsChecked"])): // si des tags sont checked, repète  la méthode pour chaque tag checked
        foreach($_SESSION["tagsChecked"] as $t){ ?>
    document.addEventListener('DOMContentLoaded', function (){
        CheckedTags("<?= $t->nomTag?>","<?= $t->idTag?>");
    })
    <?php } endif; ?>

    function CheckedIngredients(ingredient, id, qteval, uniteval = null){ /* permet de checked un ingrédient qui a été checked avant le submit et de mettre les valeurs de l'unite et de la quantité*/
        let i;                                                             /* que l'utilisateur à taper avant le submit */
        let box = document.getElementsByName(ingredient);
        let hide_input = document.getElementById("hideIngr"+id); // récupère sont hide_input et met sa valeur à true pour enregistrer dans le POST de add que l'ingrédient' soit checked
        hide_input.value = "true";
        for(i = 0;i<box.length;i++){
            box[i].checked = true;
        }
        let unite = document.getElementById("unite"+id); // récupère sont hide_input_unite et met sa valeur à uniteval en param pour enregistrer dans le POST de add sa valeur
        unite.value = uniteval;
        let qte = document.getElementById("qte"+id); // récupère sa balise qte et met sa valeur à qteval pour enregistrer dans le POST de add  sa valeur
        qte.value = qteval;
    }

    <?php if(isset($_SESSION["ingrsChecked"])): // si des ingrédients sont checked, repète  la méthode pour chaque ingrédient checked
    $i = 0;
    $quantitees = $_SESSION['qte'];
    $unitees = $_SESSION['unite'];
    foreach($_SESSION["ingrsChecked"] as $ig){ ?>
    document.addEventListener('DOMContentLoaded', function (){
        CheckedIngredients("<?= $ig->nomIngredient?>","<?= $ig->idIngredient?>","<?= $quantitees[$i] ?>","<?= $unitees[$i] ?>");
    })

    <?php $i++; } endif; ?>


</script>

<?php #----------------------------------------------ALEXANDRE___FIN------------------------------------------------------------?>

