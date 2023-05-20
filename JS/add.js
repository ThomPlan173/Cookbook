document.addEventListener('DOMContentLoaded', function () {

    /*#----------------------------------------------ALEXANDRE___DEBUT------------------------------------------------------------*/

    let content = document.getElementById("content"); /* prend le div content du template pour lui ajouter le form d'ajout de recettte */

    let div_form_rec = document.getElementById("Addform"); /* et son div  */

    let add_form_rec = document.createElement("form"); /* methode post vers le fichier add_upload_recette.php avec multipart/form-data pour permettre l'upload de fichiers */
    add_form_rec.action = "../UploadRec/add_upload_recette.php";
    add_form_rec.method = "post";
    add_form_rec.enctype = "multipart/form-data";

    let filtres = document.getElementById("filtres"); /* ajoute les filtres de tag et ingredients pour que tout soit dans le même formulaire */
    add_form_rec.appendChild(filtres);
    add_form_rec.appendChild(div_form_rec);
    content.appendChild(add_form_rec);

    let add_form_ingredient = document.createElement('form'); /* creation du form d'ajout d'un ingredient */
    add_form_ingredient.id = "add_form_ingredient";

    let add_button_ingredient = document.createElement('input');
    add_button_ingredient.id = "add_bouton_ingr";
    add_button_ingredient.value = "+ Ajouter un Ingredient";
    add_button_ingredient.type = "button";
    add_button_ingredient.setAttribute('onclick', 'add_ingredient()');


    add_form_ingredient.appendChild(add_button_ingredient);

    checkbox_ingr.appendChild(add_form_ingredient);

    let x = 0;
    for (let ingredient of vardataIngr) {

        let div = document.createElement('div'); /* creation d'un div pour chaque ingredient */
        div.className = "ingr";
        div.id = "ingr" + ingredient.idIngredient;

        let hide_input = document.createElement('input'); /* creation d'un input invisible pour renvoyer dans POST si la checkbox de l'ingredient est coché ou non */
        hide_input.hidden = true;
        hide_input.name = "hideIngr"+ingredient.idIngredient;
        hide_input.id = "hideIngr"+ingredient.idIngredient;
        hide_input.type = "text";
        hide_input.value = "false";

        /*#----------------------------------------------ALEXANDRE___FIN------------------------------------------------------------*/

        let input = document.createElement('input')
        input.type = "checkbox";
        input.name = ingredient.nomIngredient;
        input.addEventListener('input', (event) => {
            if (event.currentTarget.checked) {
                hide_input.value = "true";
                ingredient_select.push(ingredient.idIngredient);
            } else {
                hide_input.value = "false";
                for (let i = 0; i < ingredient_select.length; i++) {
                    if (ingredient_select[i] == ingredient.idIngredient) {
                        let tempon = ingredient_select.splice(i, 1);
                    }
                }
            }
        })

        let label = document.createElement('label');
        label.htmlFor = ingredient.nomIngredient;
        label.innerHTML = ingredient.nomIngredient;
        label.className = "labelIngr";

        let divgap = document.createElement("div");
        divgap.className = "divgap";

        let qte_input = document.createElement("div");
        qte_input.className = 'qte_div';

        let qte = document.createElement('input');
        qte.type = "number";
        qte.className = "quantite";
        qte.name = "qte" + ingredient.idIngredient;
        qte.id = "qte" + ingredient.idIngredient;
        qte.max = 999;
        qte.min = 1;

        let unite = document.createElement('select');
        unite.className = "unite_select";
        unite.name = "unite";
        unite.id = "unite"+ ingredient.idIngredient;

        let option1 = document.createElement("option")
        option1.value = "";
        option1.innerHTML = "";

        let option2 = document.createElement("option")
        option2.value = "g";
        option2.innerHTML = "g";

        let option3 = document.createElement("option")
        option3.value = "kg";
        option3.innerHTML = "kg";

        let option4 = document.createElement("option")
        option4.value = "ml";
        option4.innerHTML = "ml";

        let option5 = document.createElement("option")
        option5.value = "l";
        option5.innerHTML = "l";

        let option6 = document.createElement("option")
        option6.value = "cac";
        option6.innerHTML = "c.a.c";

        let option7 = document.createElement("option")
        option7.value = "cas";
        option7.innerHTML = "c.a.s";

        unite.appendChild(option1);
        unite.appendChild(option2);
        unite.appendChild(option3);
        unite.appendChild(option4);
        unite.appendChild(option5);
        unite.appendChild(option6);
        unite.appendChild(option7);

        if(x < vardataQte.length) {
            if (vardataQte[x].idIngredient == ingredient.idIngredient) {
                qte.value = vardataQte[x].quantite;
                unite.value = vardataQte[x].unite;
                x++;
            }
        }

        /*#----------------------------------------------ALEXANDRE___DEBUT------------------------------------------------------------*/

        let hide_input_unite = document.createElement('input'); /* creation d'un input invisible qui permet de renvoyer dans POST la valeur de l'unite de l'ingredient*/
        hide_input_unite.hidden = true;
        hide_input_unite.name = "hideIngrUt"+ingredient.idIngredient;
        hide_input_unite.id = "hideIngrUt"+ingredient.idIngredient;
        hide_input_unite.type = "text";
        hide_input_unite.value = unite.value;

        let addbutton  = document.getElementById("addsubmit");

        addbutton.addEventListener('click', function (){ // affecte la valeur de hide_input a l'unite au moment ou l'on submit l'ajout de la recette
            hide_input_unite.value = unite.value;
        })

        let br = document.createElement('br');

        let form_edit_ingredient = document.createElement('form');
        form_edit_ingredient.method = "get";

        let div2 = document.createElement('div');
        div2.className = "bouton_modif";

        let bouton_edit_ingredient = document.createElement('button'); // bouton d'edition qui cache les balises de l'ingredient pour le remplacer par un form de modification grace à edit_ingredient
        bouton_edit_ingredient.type = "button";
        bouton_edit_ingredient.className = "button_edit";
        bouton_edit_ingredient.id = "photo_tete";
        bouton_edit_ingredient.addEventListener("click", function (){
            form_edit_ingredient.hidden = true;
            form_delete_ingredient.hidden = true;
            label.hidden = true;
            input.hidden = true;
            unite.hidden = true;
            qte.hidden = true;
            divgap.classList.add("hidden");

            edit_ingredient(ingredient.idIngredient, ingredient.nomIngredient);
        })
       
        
        let edit = document.createElement('img');
        edit.src = "/Projet_Recettes/images/pencil-square.png";
        edit.width = 15;
        edit.height = 15;

        form_edit_ingredient.appendChild(bouton_edit_ingredient);
        bouton_edit_ingredient.appendChild(edit);

        let form_delete_ingredient = document.createElement('form');
        form_delete_ingredient.method = "get";

        let bouton_delete_ingredient = document.createElement('button'); // bouton delete qui demande une confiramtion de suppression de l'ingredient puis supprime si oui et ne fait rien sinon
        bouton_delete_ingredient.id = "photo_tete";
        bouton_delete_ingredient.name = "del";
        bouton_delete_ingredient.className = "button_delete";
        bouton_delete_ingredient.value = ingredient.idIngredient;
        bouton_delete_ingredient.addEventListener("click", function() {
            if (window.confirm("Voulais vous suprimer l'ingredient :\n" +
                ingredient.nomIngredient)) {
                form_delete_ingredient.action = "/Projet_Recettes/pages/EditIngr/deleteIngr.php";
                bouton_delete_ingredient.type = "submit" ;
            }
        })

        let del = document.createElement('img');
        del.src = "/Projet_Recettes/images/trash-fill.png";
        del.width = 15;
        del.height = 15;

        form_delete_ingredient.appendChild(bouton_delete_ingredient);
        bouton_delete_ingredient.appendChild(del);

        qte_input.appendChild(qte);
        qte_input.appendChild(unite);


        divgap.appendChild(label);
        divgap.appendChild(qte_input);

        div.appendChild(div2);
        div2.appendChild(form_edit_ingredient);
        div2.appendChild(form_delete_ingredient);
        div.appendChild(input);
        div.appendChild(hide_input);
        div.appendChild(divgap);
        div.appendChild(hide_input_unite);
        div.appendChild(br);

        checkbox_ingr.appendChild(div);
    }


    let add_form_tag = document.createElement('form'); /* creation du form d'ajout d'un tag */
    add_form_tag.id = "add_form_tag";

    let add_button_tag = document.createElement('input');
    add_button_tag.value = " + Ajouter un Tag";
    add_button_tag.type = "button";
    add_button_tag.setAttribute('onclick', 'add_tag()');


    add_form_tag.appendChild(add_button_tag);

    checkbox_tag.appendChild(add_form_tag);

    for (let tag of vardataTag) {

        let div = document.createElement('div');
        div.className = "tag";
        div.id = "tag" + tag.idTag;

        let hide_input = document.createElement('input');/* creation d'un input invisible pour renvoyer dans POST si la checkbox du tag est coché ou non */
        hide_input.hidden = true;
        hide_input.name = "hideTag"+tag.idTag;
        hide_input.id = "hideTag"+tag.idTag;
        hide_input.type = "text";
        hide_input.value = "false";

        /*#----------------------------------------------ALEXANDRE___FIN------------------------------------------------------------*/

        let input = document.createElement('input')
        input.type = "checkbox";
        input.name = tag.nomTag;
        input.addEventListener('input', (event) => {
            if (event.currentTarget.checked) {
                tag_select.push(tag.idTag);
                hide_input.value = "true";
            } else {
                hide_input.value = "false";
                for (let i = 0; i < tag_select.length; i++) {
                    if (tag_select[i] == tag.idTag) {
                        let tempon = tag_select.splice(i, 1);
                    }
                }
            }
        })

        let label = document.createElement('label');
        label.htmlFor = tag.nomTag;
        label.innerHTML = tag.nomTag;

        let br = document.createElement('br')

        let div2 = document.createElement('div');
        div2.className = "bouton_modif";

        /*#----------------------------------------------ALEXANDRE___DEBUT------------------------------------------------------------*/

        let form_edit_tag = document.createElement('form');
        form_edit_tag.method = "get";

        let bouton_edit_tag = document.createElement('button'); // bouton d'edition qui cache les balises du tag pour le remplacer par un form de modification grace à edit_tag
        bouton_edit_tag.type = "button";
        bouton_edit_tag.className = "button_edit";
        bouton_edit_tag.id = "photo_tete";
        bouton_edit_tag.addEventListener("click", function (){
            form_edit_tag.hidden = true;
            form_delete_tag.hidden = true;
            label.hidden = true;
            input.hidden = true;
            edit_tag(tag.idTag, tag.nomTag);
        })

        let edit = document.createElement('img');
        edit.src = "/Projet_Recettes/images/pencil-square.png";
        edit.width = 15;
        edit.height = 15;

        form_edit_tag.appendChild(bouton_edit_tag);
        bouton_edit_tag.appendChild(edit);

        let form_delete_tag = document.createElement('form');
        form_delete_tag.method = "get";

        let bouton_delete_tag = document.createElement('button'); // bouton delete qui demande une confiramtion de suppression du tag puis supprime si oui et ne fait rien sinon
        bouton_delete_tag.id = "photo_tete";
        bouton_delete_tag.name = "del";
        bouton_delete_tag.className = "button_delete";
        bouton_delete_tag.value = tag.idTag;
        bouton_delete_tag.addEventListener("click", function() {
            if (window.confirm("Voulais vous suprimer le tag :\n" +
                tag.nomTag)) {
                form_delete_tag.action = "/Projet_Recettes/pages/EditTag/deleteTag.php";
            }
        })

        let del = document.createElement('img');
        del.src = "/Projet_Recettes/images/trash-fill.png";
        del.width = 15;
        del.height = 15;

        form_delete_tag.appendChild(bouton_delete_tag);
        bouton_delete_tag.appendChild(del);

        div.appendChild(div2);
        div2.appendChild(form_edit_tag);
        div2.appendChild(form_delete_tag);
        div.appendChild(input);
        div.appendChild(hide_input);
        div.appendChild(label);
        div.appendChild(br);

        checkbox_tag.appendChild(div);
    };

    input_ingr.addEventListener('input', function () {

        removeAllChild(checkbox_ingr);

        let add_form_ingredient = document.createElement('form'); /* creation du form d'ajout d'un ingredient */
        add_form_ingredient.id = "add_form_ingredient";

        let add_button_ingredient = document.createElement('input');
        add_button_ingredient.value = " + Ajouter un Ingredient";
        add_button_ingredient.type = "button";

        add_button_ingredient.setAttribute('onclick', 'add_ingredient()');

        add_form_ingredient.appendChild(add_button_ingredient);

        checkbox_ingr.appendChild(add_form_ingredient);

        for (let ingredient of vardataIngr) {

            if ((ingredient.nomIngredient.toUpperCase().includes(input_ingr.value.toUpperCase())) || (ingredient_select.indexOf(ingredient.idIngredient) != -1)) {

                let div = document.createElement('div'); /* creation d'un div pour chaque ingredient */
                div.className = "ingr";
                div.id = "ingr" + ingredient.idIngredient;

                let hide_input = document.createElement('input'); /* creation d'un input invisible pour renvoyer dans POST si la checkbox de l'ingredient est coché ou non */
                hide_input.hidden = true;
                hide_input.name = "hideIngr"+ingredient.idIngredient;
                hide_input.id = "hideIngr"+ingredient.idIngredient;
                hide_input.type = "text";
                hide_input.value = "false";

                /*#----------------------------------------------ALEXANDRE___FIN------------------------------------------------------------*/

                let input = document.createElement('input')
                input.type = "checkbox";
                input.name = ingredient.nomIngredient;
                input.addEventListener('input', (event) => {
                    if (event.currentTarget.checked) {
                        hide_input.value = "true";
                        ingredient_select.push(ingredient.idIngredient);
                    } else {
                        hide_input.value = "false";
                        for (let i = 0; i < ingredient_select.length; i++) {
                            if (ingredient_select[i] == ingredient.idIngredient) {
                                let tempon = ingredient_select.splice(i, 1);
                            }
                        }
                    }
                })

                if (ingredient_select.indexOf(ingredient.idIngredient) != -1) {
                    input.checked = true;
                }

                let label = document.createElement('label');
                label.htmlFor = ingredient.nomIngredient;
                label.innerHTML = ingredient.nomIngredient;
                label.className = "labelIngr";

                let divgap = document.createElement("div");
                divgap.className = "divgap";

                let qte_input = document.createElement("div");
                qte_input.className = 'qte_div';

                let qte = document.createElement('input');
                qte.type = "number";
                qte.className = "quantite";
                qte.name = "qte" + ingredient.idIngredient;
                qte.id = "qte" + ingredient.idIngredient;
                qte.max = 999;
                qte.min = 1;

                let unite = document.createElement('select');
                unite.className = "unite_select";
                unite.name = "unite";
                unite.id = "unite"+ ingredient.idIngredient;

                let option1 = document.createElement("option")
                option1.value = "";
                option1.innerHTML = "";

                let option2 = document.createElement("option")
                option2.value = "g";
                option2.innerHTML = "g";

                let option3 = document.createElement("option")
                option3.value = "kg";
                option3.innerHTML = "kg";

                let option4 = document.createElement("option")
                option4.value = "ml";
                option4.innerHTML = "ml";

                let option5 = document.createElement("option")
                option5.value = "l";
                option5.innerHTML = "l";

                let option6 = document.createElement("option")
                option6.value = "cac";
                option6.innerHTML = "c.a.c";

                let option7 = document.createElement("option")
                option7.value = "cas";
                option7.innerHTML = "c.a.s";

                unite.appendChild(option1);
                unite.appendChild(option2);
                unite.appendChild(option3);
                unite.appendChild(option4);
                unite.appendChild(option5);
                unite.appendChild(option6);
                unite.appendChild(option7);

                for(let x = 0; x < vardataQte.length; x++) {
                    if (vardataQte[x].idIngredient == ingredient.idIngredient) {
                        qte.value = vardataQte[x].quantite;
                        unite.value = vardataQte[x].unite;
                        x++;
                    }
                }

                /*#----------------------------------------------ALEXANDRE___DEBUT------------------------------------------------------------*/

                let hide_input_unite = document.createElement('input'); /* creation d'un input invisible qui permet de renvoyer dans POST la valeur de l'unite de l'ingredient*/
                hide_input_unite.hidden = true;
                hide_input_unite.name = "hideIngrUt"+ingredient.idIngredient;
                hide_input_unite.id = "hideIngrUt"+ingredient.idIngredient;
                hide_input_unite.type = "text";
                hide_input_unite.value = unite.value;

                let addbutton  = document.getElementById("addsubmit");

                addbutton.addEventListener('click', function (){ // affecte la valeur de hide_input a l'unite au moment ou l'on submit l'ajout de la recette
                    hide_input_unite.value = unite.value;
                })

                let br = document.createElement('br')

                let form_edit_ingredient = document.createElement('form');
                form_edit_ingredient.method = "get";

                let div2 = document.createElement('div');
                div2.className = "bouton_modif";

                let bouton_edit_ingredient = document.createElement('button'); // bouton d'edition qui cache les balises de l'ingredient pour le remplacer par un form de modification grace à edit_ingredient
                bouton_edit_ingredient.type = "button";
                bouton_edit_ingredient.className = "button_edit";
                bouton_edit_ingredient.id = "photo_tete";
                bouton_edit_ingredient.addEventListener("click", function (){
                    form_edit_ingredient.hidden = true;
                    form_delete_ingredient.hidden = true;
                    label.hidden = true;
                    input.hidden = true;
                    unite.hidden = true;
                    qte.hidden = true;
                    divgap.classList.add("hidden");
                    edit_ingredient(ingredient.idIngredient, ingredient.nomIngredient);
                })

                let edit = document.createElement('img');
                edit.src = "/Projet_Recettes/images/pencil-square.png";
                edit.width = 15;
                edit.height = 15;

                form_edit_ingredient.appendChild(bouton_edit_ingredient);
                bouton_edit_ingredient.appendChild(edit);




                let form_delete_ingredient = document.createElement('form');
                form_delete_ingredient.method = "get";

                let bouton_delete_ingredient = document.createElement('button'); // bouton delete qui demande une confiramtion de suppression de l'ingredient puis supprime si oui et ne fait rien sinon
                bouton_delete_ingredient.id = "photo_tete";
                bouton_delete_ingredient.name = "del";
                bouton_delete_ingredient.className = "button_delete";
                bouton_delete_ingredient.value = ingredient.idIngredient;
                bouton_delete_ingredient.addEventListener("click", function() {
                    if (window.confirm("Voulais vous suprimer l'ingredient :\n" +
                        ingredient.nomIngredient)) {
                        form_delete_ingredient.action = "/Projet_Recettes/pages/EditIngr/deleteIngr.php";
                        bouton_delete_ingredient.type = "submit" ;
                    }
                })

                let del = document.createElement('img');
                del.src = "/Projet_Recettes/images/trash-fill.png";
                del.width = 15;
                del.height = 15;

                form_delete_ingredient.appendChild(bouton_delete_ingredient);
                bouton_delete_ingredient.appendChild(del);

                qte_input.appendChild(qte);
                qte_input.appendChild(unite);

                divgap.appendChild(label);
                divgap.appendChild(qte_input);

                div.appendChild(div2);
                div2.appendChild(form_edit_ingredient);
                div2.appendChild(form_delete_ingredient);
                div.appendChild(input);
                div.appendChild(hide_input);
                div.appendChild(divgap);
                div.appendChild(hide_input_unite);
                div.appendChild(br);


                checkbox_ingr.appendChild(div);

            }
        }

    })



    input_tag.addEventListener('input', function () {

        removeAllChild(checkbox_tag);

        let add_form_tag = document.createElement('form'); /* creation du form d'ajout d'un tag */
        add_form_tag.id = "add_form_tag";

        let add_button_tag = document.createElement('input');
        add_button_tag.value = " + Ajouter un Tag";
        add_button_tag.type = "button";
        add_button_tag.setAttribute('onclick', 'add_tag()');


        add_form_tag.appendChild(add_button_tag);

        checkbox_tag.appendChild(add_form_tag);

        for (let tag of vardataTag) {

            if ((tag.nomTag.toUpperCase().includes(input_tag.value.toUpperCase())) || (tag_select.indexOf(tag.idTag) != -1)) {

                let div = document.createElement('div');
                div.className = "tag";
                div.id = "tag" + tag.idTag;

                let hide_input = document.createElement('input');/* creation d'un input invisible pour renvoyer dans POST si la checkbox du tag est coché ou non */
                hide_input.hidden = true;
                hide_input.name = "hideTag"+tag.idTag;
                hide_input.id = "hideTag"+tag.idTag;
                hide_input.type = "text";
                hide_input.value = "false";

                /*#----------------------------------------------ALEXANDRE___FIN------------------------------------------------------------*/

                let input = document.createElement('input')
                input.type = "checkbox";
                input.name = tag.nomTag;
                input.addEventListener('input', (event) => {
                    if (event.currentTarget.checked) {
                        tag_select.push(tag.idTag);
                        hide_input.value = "true";
                    } else {
                        hide_input.value = "false";
                        for (let i = 0; i < tag_select.length; i++) {
                            if (tag_select[i] == tag.idTag) {
                                let tempon = tag_select.splice(i, 1);
                            }
                        }
                    }
                })

                if (tag_select.indexOf(tag.idTag) != -1) {
                    input.checked = true;
                }

                let label = document.createElement('label');
                label.htmlFor = tag.nomTag;
                label.innerHTML = tag.nomTag;

                let br = document.createElement('br')

                let div2 = document.createElement('div');
                div2.className = "bouton_modif";

                /*#----------------------------------------------ALEXANDRE___DEBUT------------------------------------------------------------*/

                let form_edit_tag = document.createElement('form');
                form_edit_tag.method = "get";

                let bouton_edit_tag = document.createElement('button'); // bouton d'edition qui cache les balises du tag pour le remplacer par un form de modification grace à edit_tag
                bouton_edit_tag.type = "button";
                bouton_edit_tag.className = "button_edit";
                bouton_edit_tag.id = "photo_tete";
                bouton_edit_tag.addEventListener("click", function (){
                    form_edit_tag.hidden = true;
                    form_delete_tag.hidden = true;
                    label.hidden = true;
                    input.hidden = true;
                    edit_tag(tag.idTag, tag.nomTag);
                })

                let edit = document.createElement('img');
                edit.src = "/Projet_Recettes/images/pencil-square.png";
                edit.width = 15;
                edit.height = 15;

                form_edit_tag.appendChild(bouton_edit_tag);
                bouton_edit_tag.appendChild(edit);

                let form_delete_tag = document.createElement('form');
                form_delete_tag.method = "get";

                let bouton_delete_tag = document.createElement('button'); // bouton delete qui demande une confiramtion de suppression du tag puis supprime si oui et ne fait rien sinon
                bouton_delete_tag.id = "photo_tete";
                bouton_delete_tag.name = "del";
                bouton_delete_tag.className = "button_delete";
                bouton_delete_tag.value = tag.idTag;
                bouton_delete_tag.addEventListener("click", function() {
                    if (window.confirm("Voulais vous suprimer le tag :\n" +
                        tag.nomTag)) {
                        form_delete_tag.action = "/Projet_Recettes/pages/EditTag/deleteTag.php";
                    }
                })

                let del = document.createElement('img');
                del.src = "/Projet_Recettes/images/trash-fill.png";
                del.width = 15;
                del.height = 15;

                form_delete_tag.appendChild(bouton_delete_tag);
                bouton_delete_tag.appendChild(del);

                div.appendChild(div2);
                div2.appendChild(form_edit_tag);
                div2.appendChild(form_delete_tag);
                div.appendChild(input);
                div.appendChild(hide_input);
                div.appendChild(label);
                div.appendChild(br);

                checkbox_tag.appendChild(div);

            }
        }

    })

})
/*#----------------------------------------------ALEXANDRE___FIN------------------------------------------------------------*/