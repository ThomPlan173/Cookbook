document.addEventListener('DOMContentLoaded', function () {

    for (let ingredient of vardataIngr) {

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
            recherche()
        })

        let label = document.createElement('label');
        label.htmlFor = ingredient.nomIngredient;
        label.innerHTML = ingredient.nomIngredient;

        let br = document.createElement('br')

        checkbox_ingr.appendChild(input);
        checkbox_ingr.appendChild(label);
        checkbox_ingr.appendChild(br);
    }


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
            recherche()
        })

        let label = document.createElement('label');
        label.htmlFor = tag.nomTag;
        label.innerHTML = tag.nomTag;
        let br = document.createElement('br')

        checkbox_tag.appendChild(input);
        checkbox_tag.appendChild(label);
        checkbox_tag.appendChild(br);
    }

    recherche();



    input_ingr.addEventListener('input', function () {

        removeAllChild(checkbox_ingr);

        for (let ingredient of vardataIngr) {

            if ((ingredient.nomIngredient.toUpperCase().includes(input_ingr.value.toUpperCase())) || (ingredient_select.indexOf(ingredient.idIngredient) != -1)) {

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
                    recherche();
                })
                if (ingredient_select.indexOf(ingredient.idIngredient) != -1) {
                    input.checked = true;
                }

                let label = document.createElement('label');
                label.htmlFor = ingredient.nomIngredient;
                label.innerHTML = ingredient.nomIngredient;

                let br = document.createElement('br')

                checkbox_ingr.appendChild(input);
                checkbox_ingr.appendChild(label);
                checkbox_ingr.appendChild(br);

            }
        }

    })



    input_tag.addEventListener('input', function () {

        removeAllChild(checkbox_tag);

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

                    recherche();

                })
                if (tag_select.indexOf(tag.idTag) != -1) {
                    input.checked = true;
                }

                let label = document.createElement('label');
                label.htmlFor = tag.nomTag;
                label.innerHTML = tag.nomTag;

                let br = document.createElement('br')

                let delete_form_ingredient = document.createElement('form');
                delete_form_ingredient.method = "get";
                delete_form_ingredient.action = "pages/editIngredient.php";

                let bouton_delete_ingredient = document.createElement('button');
                bouton_delete_ingredient.type = "submit";
                bouton_delete_ingredient.id = "photo_tete";
                bouton_delete_ingredient.name = "idIngredient";
                bouton_delete_ingredient.value = rit_select[i].idIngredient;

                let edit = document.createElement('img');
                edit.src = "images/pencil-square.png";
                edit.width = 15;
                edit.height = 15;


                let form_edit_ingredient = document.createElement('form');
                form_edit_ingredient.method = "post";


                let bouton_edit_ingredient = document.createElement('button');
                bouton_edit_ingredient.id = "photo_tete";
                bouton_edit_ingredient.name = "del";
                bouton_edit_ingredient.value = rit_select[i].idIngredient;
                bouton_edit_ingredient.addEventListener("click", function() {
                    if (window.confirm("Voulais vous suprimer l'ingredient :\n" +
                        rit_select[i].nomIngredient)) {
                        form2.action = "pages/deleteIngredient.php";
                        bouton2.type = "submit";
                    }
                })

                let del = document.createElement('img');
                del.src = "images/trash-fill.png";
                del.width = 15;
                del.height = 15;

                admin.appendChild(form1);
                form1.appendChild(bouton1);
                bouton1.appendChild(edit);

                admin.appendChild(form2);
                form2.appendChild(bouton2);
                bouton2.appendChild(del);

                checkbox_tag.appendChild(input);
                checkbox_tag.appendChild(label);
                checkbox_tag.appendChild(_form_ingredient);
                checkbox_tag.appendChild(br);

            }
        }
        recherche();

    })

})