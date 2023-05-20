<?php
session_start();
require "." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();


$cb = new \cb\cookbookDB;
$sr  = new Browser\Recherche();
$ss = new \Session\Session();
$ss->cleanSession();

$_SESSION['page'] =$_SERVER['REQUEST_URI'];
?>

<?php $dataRit = $cb->getAllRIT(); ?>

<?php ob_start();
$sr->generatesearch($cb); ?>

<script>
    let vardataRit = <?php echo json_encode($dataRit); ?>;

    let input_ingr = document.getElementById("search_ingredient");
    let input_tag = document.getElementById("search_tag");
    let input_rit = document.getElementById("search_rit");
    let radio_alph = document.getElementById("trie");

    let checkbox_ingr = document.getElementById("checkbox_ingredient");
    let checkbox_tag = document.getElementById("checkbox_tag");
    let checkbox_rit = document.getElementById("liste_recette");

    let ingredient_select = [];
    let tag_select = [];
    let rit_select = vardataRit;
    let alph = true;

    function removeAllChild(parent) {
        while (parent.firstChild) {
            parent.removeChild(parent.firstChild);
        }
    }
</script>

<script src="JS/index.js"></script>

<script>
    function recherche() {

        rit_select = [];
        removeAllChild(checkbox_rit);

        for (let rit of vardataRit) {
            if (rit.nomRecette.toUpperCase().includes(input_rit.value.toUpperCase())) {
                let n_ingredient = 0;
                for (let id of ingredient_select) {
                    if (rit.liste_ingredients != null) {
                        if (rit.liste_ingredients.indexOf(id) != -1) {

                            n_ingredient++;
                        }
                    }
                }
                if (n_ingredient == ingredient_select.length) {
                    let n_tag = 0;
                    for (let id of tag_select) {
                        if (rit.liste_tags != null) {
                            if (rit.liste_tags.indexOf(id) != -1) {
                                n_tag++;
                            }
                        }
                    }
                    if (n_tag == tag_select.length) {
                        rit_select.push(rit);

                    }
                }
            }
        }


        if (alph) {
            for (let i = 0; i < rit_select.length; i++) {

                let recette = document.createElement('div');
                recette.className = "recette";

                let form = document.createElement('form');
                form.method = "get";
                form.action = "pages/recette.php";

                let bouton = document.createElement('button');
                bouton.className = "bouton_image_recette";
                bouton.type = "submit";
                bouton.id = "photo_tete";
                bouton.name = "idRecette";
                bouton.value = rit_select[i].idRecette;

                let image = document.createElement('img');
                image.className = "image_recette";
                image.src = rit_select[i].imgRecette;

                image.addEventListener("mousemove", function (){
                    recette.style.border = "5px";
                    recette.style.width = recette.style.width  + "- 5px";
                    recette.style.border = "solid";

                })

                image.addEventListener("mouseout", function (){
                    recette.style.width = recette.style.width + "+ 5px";
                    recette.style.border = "unset";
                })


                let div = document.createElement('div');
                div.className = "text_ingr";

                let nom = document.createElement('h3');
                nom.innerHTML = rit_select[i].nomRecette + " :";

                let desc = document.createElement('p');
                desc.innerHTML = rit_select[i].Description;

                checkbox_rit.appendChild(recette);

                recette.appendChild(form);
                form.appendChild(bouton);
                bouton.appendChild(image);

                recette.appendChild(div);
                div.appendChild(nom);
                div.appendChild(desc);

                <?php if (isset($_SESSION['login'])) : ?>
                    let admin = document.createElement('div');
                    admin.className = "bouton_admin"

                    let form1 = document.createElement('form');
                    form1.method = "get";
                    form1.action = "pages/EditRec/edit.php";

                    let bouton1 = document.createElement('button');
                    bouton1.type = "submit";
                    bouton1.id = "photo_tete";
                    bouton1.className = "button_edit";
                    bouton1.name = "idRecette";
                    bouton1.value = rit_select[i].idRecette;

                    let edit = document.createElement('img');
                    edit.src = "images/pencil-square.png";
                    edit.width = 25;
                    edit.height = 25;

                    let form2 = document.createElement('form');
                    form2.method = "get";


                    let bouton2 = document.createElement('button');
                    bouton2.id = "photo_tete";
                    bouton2.name = "del";
                    bouton2.className = "button_delete";
                    bouton2.value = rit_select[i].idRecette;
                    bouton2.addEventListener("click", function() {
                        if (window.confirm("Voulez-vous suprimer la recette :\n" +
                                rit_select[i].nomRecette)) {
                            form2.action = "pages/EditRec/delete.php";
                            bouton2.type = "submit";
                        }
                    })

                    let del = document.createElement('img');
                    del.src = "images/trash-fill.png";
                    del.width = 25;
                    del.height = 25;

                    div.appendChild(admin);

                    admin.appendChild(form1);
                    form1.appendChild(bouton1);
                    bouton1.appendChild(edit);

                    admin.appendChild(form2);
                    form2.appendChild(bouton2);
                    bouton2.appendChild(del);


                <?php endif ?>
            }
        } else {
            for (let i = (rit_select.length - 1); i => 0; i--) {

                let recette = document.createElement('div');
                recette.className = "recette";

                let form = document.createElement('form');
                form.method = "get";
                form.action = "pages/recette.php";

                let bouton = document.createElement('button');
                bouton.className = "bouton_image_recette";
                bouton.type = "submit";
                bouton.id = "photo_tete";
                bouton.name = "idRecette";
                bouton.value = rit_select[i].idRecette;

                let image = document.createElement('img');
                image.className = "image_recette";
                image.src = rit_select[i].imgRecette;


                let div = document.createElement('div');
                div.className = "text_ingr";

                let nom = document.createElement('h3');
                nom.innerHTML = rit_select[i].nomRecette + " :";

                let desc = document.createElement('p');
                desc.innerHTML = rit_select[i].Description;

                checkbox_rit.appendChild(recette);

                recette.appendChild(form);
                form.appendChild(bouton);
                bouton.appendChild(image);

                recette.appendChild(div);
                div.appendChild(nom);
                div.appendChild(desc);

                <?php if (isset($_SESSION['login'])) : ?>
                    let admin = document.createElement('div');
                    admin.className = "bouton_admin";

                    let form1 = document.createElement('form');
                    form1.method = "get";
                    form1.action = "pages/EditRec/edit.php";

                    let bouton1 = document.createElement('button');
                    bouton1.type = "submit";
                    bouton1.id = "photo_tete";
                    bouton1.className = "button_edit";
                    bouton1.name = "idRecette";
                    bouton1.value = rit_select[i].idRecette;

                    let edit = document.createElement('img');
                    edit.src = "images/pencil-square.png";
                    edit.width = 25;
                    edit.height = 25;

                    let form2 = document.createElement('form');
                    form2.method = "post";


                    let bouton2 = document.createElement('button');
                    bouton2.id = "photo_tete";
                    bouton2.name = "del";
                    bouton2.className = "button_delete";
                    bouton2.value = rit_select[i].idRecette;
                    bouton2.addEventListener("click", function() {
                        if (window.confirm("Voulais vous suprimer la recette :\n" +
                                rit_select[i].nomRecette)) {
                            form2.action = "pages/EditRec/delete.php";
                            bouton2.type = "submit";
                        }
                    })

                    let del = document.createElement('img');
                    del.src = "images/trash-fill.png";
                    del.width = 25;
                    del.height = 25;

                    recette.appendChild(admin);

                    admin.appendChild(form1);
                    form1.appendChild(bouton1);
                    bouton1.appendChild(edit);

                    admin.appendChild(form2);
                    form2.appendChild(bouton2);
                    bouton2.appendChild(del);


                <?php endif ?>
            }
        }
    }
</script>

<?php $content = ob_get_clean() ?>

<?php ob_start() ?>

<link rel="stylesheet" href="CSS/index.css">

<?php $css = ob_get_clean() ?>

<?php ob_start() ?>

<script></script>

<?php $js = ob_get_clean() ?>

<?php Template::render($content, $css, $js) ?>