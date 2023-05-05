<?php
session_start();
require "." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();


$cb = new \cb\CoobookDB;
$sr  = new Browser\Recherche();

$d = new \Edit\Delete();



?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
       <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<?php $dataRit = $cb->getAllRIT() ; ?>

<?php ob_start() ;


if (isset($_POST["del"])) {
    $id = $_POST["del"];
    
    $d->generateform($id);
}

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

                    let edit = document.createElement('img');
                    edit.src = "images/pencil-square.png";
                    edit.width =  25 ;
                    edit.height = 25 ;

                    let form2 = document.createElement('form');
                    form2.method = "post";
                    //form2.action = "pages/delete.php";

                    let bouton2 = document.createElement('button');
                    bouton2.type = "submit";
                    bouton2.id = "photo_tete";
                    bouton2.name = "del";
                    bouton2.setAttribute("data-toggle","modal");
                    bouton2.setAttribute("data-target","#exampleModal");
                    bouton2.value = rit.idRecette;

                    let del = document.createElement('img');
                    del.src = "images/trash-fill.png";
                    del.width =  25 ;
                    del.height = 25 ;

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


    </script>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1"  aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Voulez-vous vraiment supprimer la recette ?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Confirmer ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-primary">Enregistrer</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#myModal').on('shown.bs.modal', function() {
                $('#myInput').trigger('focus')
            })
        </script>


<?php $content = ob_get_clean() ?>

<?php ob_start() ?>

    <link rel="stylesheet" href="CSS/index.css">

<?php $css = ob_get_clean() ?>

<?php ob_start() ?>

    <script></script>

<?php $js = ob_get_clean() ?>

<?php Template::render($content, $css, $js) ?>