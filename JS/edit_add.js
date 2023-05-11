document.addEventListener('DOMContentLoaded', function () {

    let add_form_ingredient = document.createElement('form');
    add_form_ingredient.id = "add_form_ingredient";

    let add_button_ingredient = document.createElement('input');
    add_button_ingredient.value = " + Ajouter un Ingredient";
    add_button_ingredient.type = "button";
    add_button_ingredient.setAttribute('onclick', 'add_ingredient()');


    add_form_ingredient.appendChild(add_button_ingredient);

    checkbox_ingr.appendChild(add_form_ingredient);

    for (let ingredient of vardataIngr) {

        let div = document.createElement('div');
        div.id = "ingr"+ingredient.idIngredient;
        let input = document.createElement('input')
        input.type = "checkbox";
        input.name = ingredient.nomIngredient;
        input.addEventListener('input', (event) => {
            if (event.currentTarget.checked) {
                ingredient_select.push(ingredient.idIngredient);
            } else {
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

        let br = document.createElement('br')

        let form_edit_ingredient = document.createElement('form');
        form_edit_ingredient.method = "get";

        let bouton_edit_ingredient = document.createElement('input');
        bouton_edit_ingredient.type = "button";
        bouton_edit_ingredient.id = "photo_tete";
        bouton_edit_ingredient.addEventListener("click", function (){
            form_edit_ingredient.hidden = true;
            form_delete_ingredient.hidden = true;
            label.hidden = true;
            input.hidden = true;
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

        let bouton_delete_ingredient = document.createElement('button');
        bouton_delete_ingredient.id = "photo_tete";
        bouton_delete_ingredient.name = "del";
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

        div.appendChild(input);
        div.appendChild(label);
        div.appendChild(form_edit_ingredient);
        div.appendChild(form_delete_ingredient);
        div.appendChild(br);

        checkbox_ingr.appendChild(div);
    }

    let add_form_tag = document.createElement('form')
    let add_button_tag = document.createElement('input');
    add_button_tag.value = " + Ajouter un Tag";
    add_button_tag.type = "button";
    add_button_tag.setAttribute('onclick', 'add_tag()');
    add_form_tag.appendChild(add_button_tag);

    checkbox_tag.appendChild(add_form_tag);



    for (let tag of vardataTag) {



        let input = document.createElement('input')
        input.type = "checkbox";
        input.name = tag.nomTag;
        input.addEventListener('input', (event) => {
            if (event.currentTarget.checked) {
                tag_select.push(tag.idTag);
            } else {
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

        let form_edit_tag = document.createElement('form');
        form_edit_tag.method = "get";

        let bouton_edit_tag = document.createElement('button');
        bouton_edit_tag.type = "submit";
        bouton_edit_tag.id = "photo_tete";
        bouton_edit_tag.name = "idTag";
        bouton_edit_tag.value = tag.idTag;

        let edit = document.createElement('img');
        edit.src = "/Projet_Recettes/images/pencil-square.png";
        edit.width = 15;
        edit.height = 15;

        form_edit_tag.appendChild(bouton_edit_tag);
        bouton_edit_tag.appendChild(edit);

        let form_delete_tag = document.createElement('form');
        form_delete_tag.method = "get";

        let bouton_delete_tag = document.createElement('button');
        bouton_delete_tag.id = "photo_tete";
        bouton_delete_tag.name = "del";
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



        checkbox_tag.appendChild(input);
        checkbox_tag.appendChild(label);
        checkbox_tag.appendChild(form_edit_tag);
        checkbox_tag.appendChild(form_delete_tag);
        checkbox_tag.appendChild(br);
    }

    ;



    input_ingr.addEventListener('input', function () {

        removeAllChild(checkbox_ingr);

        let add_form_ingredient = document.createElement('form');
        add_form_ingredient.id = "add_form_ingredient";

        let add_button_ingredient = document.createElement('input');
        add_button_ingredient.value = " + Ajouter un Ingredient";
        add_button_ingredient.type = "button";

        add_button_ingredient.setAttribute('onclick', 'add_ingredient()');

        add_form_ingredient.appendChild(add_button_ingredient);

        checkbox_ingr.appendChild(add_form_ingredient);

        for (let ingredient of vardataIngr) {

            if ((ingredient.nomIngredient.toUpperCase().includes(input_ingr.value.toUpperCase())) || (ingredient_select.indexOf(ingredient.idIngredient) != -1)) {

                let div = document.createElement('div');
                div.id = "ingr"+ingredient.idIngredient;

                let input = document.createElement('input')
                input.type = "checkbox";
                input.name = ingredient.nomIngredient;
                input.addEventListener('input', (event) => {
                    if (event.currentTarget.checked) {
                        ingredient_select.push(ingredient.idIngredient);
                    } else {
                        for (let i = 0; i < ingredient_select.length; i++) {
                            if (ingredient_select[i] == ingredient.idIngredient) {
                                let tempon = ingredient_select.splice(i, 1);
                            }
                        }
                    }
                    ;
                })
                if (ingredient_select.indexOf(ingredient.idIngredient) != -1) {
                    input.checked = true;
                }

                let label = document.createElement('label');
                label.htmlFor = ingredient.nomIngredient;
                label.innerHTML = ingredient.nomIngredient;

                let br = document.createElement('br')

                let form_edit_ingredient = document.createElement('form');
                form_edit_ingredient.method = "get";

                let bouton_edit_ingredient = document.createElement('input');
                bouton_edit_ingredient.type = "button";
                bouton_edit_ingredient.id = "photo_tete";
                bouton_edit_ingredient.addEventListener("click", function (){
                    form_edit_ingredient.hidden = true;
                    form_delete_ingredient.hidden = true;
                    label.hidden = true;
                    input.hidden = true;
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

                let bouton_delete_ingredient = document.createElement('button');
                bouton_delete_ingredient.id = "photo_tete";
                bouton_delete_ingredient.name = "del";
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

                div.appendChild(input);
                div.appendChild(label);
                div.appendChild(form_edit_ingredient);
                div.appendChild(form_delete_ingredient);
                div.appendChild(br);

                checkbox_ingr.appendChild(div);

            }
        }

    })



    input_tag.addEventListener('input', function () {

        removeAllChild(checkbox_tag);

        let add_form_tag = document.createElement('form')
        let add_button_tag = document.createElement('button');
        add_button_tag.textContent = " + Ajouter un Tag";

        add_form_tag.appendChild(add_button_tag);

        checkbox_tag.appendChild(add_form_tag);

        for (let tag of vardataTag) {

            if ((tag.nomTag.toUpperCase().includes(input_tag.value.toUpperCase())) || (tag_select.indexOf(tag.idTag) != -1)) {
                let input = document.createElement('input')
                input.type = "checkbox";
                input.name = tag.nomTag;
                input.addEventListener('input', (event) => {
                    if (event.currentTarget.checked) {
                        tag_select.push(tag.idTag);
                    } else {
                        for (let i = 0; i < tag_select.length; i++) {
                            if (tag_select[i] == tag.idTag) {
                                let tempon = tag_select.splice(i, 1);
                            }
                        }
                    }

                    ;

                })
                if (tag_select.indexOf(tag.idTag) != -1) {
                    input.checked = true;
                }

                let label = document.createElement('label');
                label.htmlFor = tag.nomTag;
                label.innerHTML = tag.nomTag;

                let br = document.createElement('br')

                let form_edit_tag = document.createElement('form');
                form_edit_tag.method = "get";

                let bouton_edit_tag = document.createElement('button');
                bouton_edit_tag.type = "submit";
                bouton_edit_tag.id = "photo_tete";
                bouton_edit_tag.name = "idTag";
                bouton_edit_tag.value = tag.idTag;

                let edit = document.createElement('img');
                edit.src = "/Projet_Recettes/images/pencil-square.png";
                edit.width = 15;
                edit.height = 15;

                form_edit_tag.appendChild(bouton_edit_tag);
                bouton_edit_tag.appendChild(edit);

                let form_delete_tag = document.createElement('form');
                form_delete_tag.method = "get";

                let bouton_delete_tag = document.createElement('button');
                bouton_delete_tag.id = "photo_tete";
                bouton_delete_tag.name = "del";
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



                checkbox_tag.appendChild(input);
                checkbox_tag.appendChild(label);
                checkbox_tag.appendChild(form_edit_tag);
                checkbox_tag.appendChild(form_delete_tag);
                checkbox_tag.appendChild(br);

            }
        }

    })

})