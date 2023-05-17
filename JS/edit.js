document.addEventListener('DOMContentLoaded', function () {

    let add_form_ingredient = document.createElement('form');
    add_form_ingredient.id = "add_form_ingredient";

    let add_button_ingredient = document.createElement('input');
    add_button_ingredient.id = "add_bouton_inrg";
    add_button_ingredient.value = "+ Ajouter un Ingredient";
    add_button_ingredient.type = "button";
    add_button_ingredient.setAttribute('onclick', 'add_ingredient()');


    add_form_ingredient.appendChild(add_button_ingredient);

    checkbox_ingr.appendChild(add_form_ingredient);

    let x = 0;
    for (let ingredient of vardataIngr) {

        let div = document.createElement('div');
        div.className = "ingr";
        div.id = "ingr" + ingredient.idIngredient;

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

        let qte = document.createElement('input');
        qte.type = "number";
        qte.className = "quantite";
        qte.name = "qte" + ingredient.nomIngredient;
        qte.max = 999;
        qte.min = 1;

        let unite = document.createElement('select');
        unite.className = "unite_select";
        unite.name = "unite";

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

        let br = document.createElement('br');

        let form_edit_ingredient = document.createElement('form');
        form_edit_ingredient.method = "get";

        let div2 = document.createElement('div');
        div2.className = "bouton_modif";

        let bouton_edit_ingredient = document.createElement('button');
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

        div.appendChild(div2);
        div2.appendChild(form_edit_ingredient);
        div2.appendChild(form_delete_ingredient);
        div.appendChild(input);
        div.appendChild(label);
        div.appendChild(qte);
        div.appendChild(unite);
        div.appendChild(br);

        checkbox_ingr.appendChild(div);
    }


    let add_form_tag = document.createElement('form');
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

        let div2 = document.createElement('div');
        div2.className = "bouton_modif";

        let form_edit_tag = document.createElement('form');
        form_edit_tag.method = "get";

        let bouton_edit_tag = document.createElement('button');
        bouton_edit_tag.type = "button";
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

        div.appendChild(div2);
        div2.appendChild(form_edit_tag);
        div2.appendChild(form_delete_tag);
        div.appendChild(input);
        div.appendChild(label);
        div.appendChild(br);

        checkbox_tag.appendChild(div);
    };

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
                div.className = "ingr";
                div.id = "ingr" + ingredient.idIngredient;

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

                let qte = document.createElement('input');
                qte.type = "number";
                qte.className = "quantite";
                qte.name = "qte" + ingredient.nomIngredient;
                qte.max = 999;
                qte.min = 1;

                let unite = document.createElement('select');
                unite.className = "unite_select";
                unite.name = "unite";

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

                let br = document.createElement('br')

                let form_edit_ingredient = document.createElement('form');
                form_edit_ingredient.method = "get";

                let div2 = document.createElement('div');
                div2.className = "bouton_modif";

                let bouton_edit_ingredient = document.createElement('button');
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

                div.appendChild(div2);
                div2.appendChild(form_edit_ingredient);
                div2.appendChild(form_delete_ingredient);
                div.appendChild(input);
                div.appendChild(label);
                div.appendChild(qte);
                div.appendChild(unite);
                div.appendChild(br);


                checkbox_ingr.appendChild(div);

            }
        }

    })



    input_tag.addEventListener('input', function () {

        removeAllChild(checkbox_tag);

        let add_form_tag = document.createElement('form');
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

                let div2 = document.createElement('div');
                div2.className = "bouton_modif";

                let form_edit_tag = document.createElement('form');
                form_edit_tag.method = "get";

                let bouton_edit_tag = document.createElement('button');
                bouton_edit_tag.type = "button";
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

                div.appendChild(div2);
                div2.appendChild(form_edit_tag);
                div2.appendChild(form_delete_tag);
                div.appendChild(input);
                div.appendChild(label);
                div.appendChild(br);

                checkbox_tag.appendChild(div);

            }
        }

    })

})