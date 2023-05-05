<?php
session_start();
require "." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();
$_SESSION['page'] = "tags";

$cb = new \cb\CoobookDB;
$sr  = new Browser\Recherche();
$ls = new Browser\Liste();
?>

<?php $dataRit = $cb->getAllRIT() ; ?>

<?php ob_start() ;
    $sr->generatesearch($cb); ?>

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

    <script src="JS/index.js"></script>

    <script>
        function recherche(){

            rit_select = [];
            removeAllChild(checkbox_rit);

            for(let rit of vardataRit){
                if(rit.nomRecette.toUpperCase().includes(input_rit.value.toUpperCase())){
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
                        if(n_tag == tag_select.length){
                            rit_select.push(rit);

                        }
                    }
                }
            }

            for(let rit of rit_select){

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
                bouton.value = rit.idRecette;

                let image = document.createElement('img');
                image.className = "image_recette";
                image.src = rit.imgRecette;


                let div = document.createElement('div');

                let nom = document.createElement('h3');
                nom.innerHTML = rit.nomRecette + " :";

                let desc = document.createElement('p');
                desc.innerHTML =  rit.Description;

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
                    form1.action = "pages/edit.php";

                    let bouton1 = document.createElement('button');
                    bouton1.type = "submit";
                    bouton1.id = "photo_tete";
                    bouton1.name = "idRecette";
                    bouton1.value = rit.idRecette;

                    let svg1 = document.createElement('svg');
                    svg1.xmlns = "http://www.w3.org/2000/svg";
                    svg1.width = "16";
                    svg1.height = "16";
                    svg1.fill = "currentColor";
                    svg1.className = "bi bi-pencil-square";
                    svg1.viewBox = "0 0 16 16";

                    let path1 = document.createElement('path');
                    path1.d = "M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z";

                    let path2 = document.createElement('path');
                    path2.fillrule = "evenodd";
                    path2.d = "M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z";


                    let form2 = document.createElement('form');
                    form2.method = "get";
                    form2.action = "pages/delete.php";

                    let bouton2 = document.createElement('button');
                    bouton2.type = "submit";
                    bouton2.id = "photo_tete";
                    bouton2.name = "del";
                    bouton2.value = rit.idRecette;

                    let svg2 = document.createElement('svg');
                    svg2.xmlns = "http://www.w3.org/2000/svg";
                    svg2.width = "16";
                    svg2.height = "16";
                    svg2.fill = "currentColor";
                    svg2.className = "bi bi-trash3-fill";
                    svg2.viewBox = "0 0 16 16";

                    let path3 = document.createElement('path');
                    path3.d = "M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z";

                    recette.appendChild(admin);

                    admin.appendChild(form1);
                    form1.appendChild(bouton1);
                    bouton1.appendChild(svg1);
                    svg1.appendChild(path1);
                    svg1.appendChild(path2);

                    admin.appendChild(form2);
                    form2.appendChild(bouton2);
                    bouton2.appendChild(svg2);
                    svg2.appendChild(path3);


                <?php endif ?>
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