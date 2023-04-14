document.addEventListener('DOMContentLoaded', function () {

    let input_ingr = document.getElementById("search_ingredient");
    let input_tag = document.getElementById("search_tag");

    let checkbox_ingr = document.getElementById("checkbox_ingredient");
    let checkbox_tag = document.getElementById("checkbox_tag");

    let ingredient_select = [];
    let tag_select = [];

    function removeAllChild(parent) {
        while (parent.firstChild) {
            parent.removeChild(parent.firstChild);
        }
    }


    for(let ingredient of vardataIngr){

        let input = document.createElement('input')
        input.type = "checkbox";
        input.name = ingredient.nomIngredient;
        input.addEventListener('input', (event) => {
            if (event.currentTarget.checked) {
                ingredient_select.push(ingredient.idIngredient);
            } else {
                for(let i = 0; i < ingredient_select.length; i++) {
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

        checkbox_ingr.appendChild(input);
        checkbox_ingr.appendChild(label);
        checkbox_ingr.appendChild(br);
    }



    for(let tag of vardataTag){

        let input = document.createElement('input')
        input.type = "checkbox";
        input.name = tag.nomTag;
        input.addEventListener('input', (event) => {
            if (event.currentTarget.checked) {
                tag_select.push(tag.idTag);
            } else {
                for(let i = 0; i < tag_select.length; i++) {
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

        checkbox_tag.appendChild(input);
        checkbox_tag.appendChild(label);
        checkbox_tag.appendChild(br);
    }



    input_ingr.addEventListener('input', function (){

        removeAllChild(checkbox_ingr);

        for (let ingredient of vardataIngr) {

            if ((ingredient.nomIngredient.toUpperCase().includes(input_ingr.value.toUpperCase())) || (ingredient_select.indexOf(ingredient.idIngredient) != -1)){

                let input = document.createElement('input')
                input.type = "checkbox";
                input.name = ingredient.nomIngredient;
                input.addEventListener('input', (event) => {
                    if (event.currentTarget.checked) {
                        ingredient_select.push(ingredient.idIngredient);
                    } else {
                        for(let i = 0; i < ingredient_select.length; i++) {
                            if (ingredient_select[i] == ingredient.idIngredient) {
                                let tempon = ingredient_select.splice(i, 1);
                            }
                        }
                    }
                })
                if(ingredient_select.indexOf(ingredient.idIngredient) != -1) {
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



    input_tag.addEventListener('input', function (){

        removeAllChild(checkbox_tag);

        for (let tag of vardataTag) {

            if((tag.nomTag.toUpperCase().includes(input_tag.value.toUpperCase())) || (tag_select.indexOf(tag.idTag) != -1)){
                let input = document.createElement('input')
                input.type = "checkbox";
                input.name = tag.nomTag;
                input.addEventListener('input', (event) => {
                    if (event.currentTarget.checked) {
                        tag_select.push(tag.idTag);
                    } else {
                        for(let i = 0; i < tag_select.length; i++) {
                            if (tag_select[i] == tag.idTag) {
                                let tempon = tag_select.splice(i, 1);
                            }
                        }
                    }
                })
                if(tag_select.indexOf(tag.idTag) != -1){
                    input.checked = true;
                }

                let label = document.createElement('label');
                label.htmlFor = tag.nomTag;
                label.innerHTML = tag.nomTag;

                let br = document.createElement('br')

                checkbox_tag.appendChild(input);
                checkbox_tag.appendChild(label);
                checkbox_tag.appendChild(br);
            }
        }
    })

})