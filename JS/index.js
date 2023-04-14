document.addEventListener('DOMContentLoaded', function () {

    let input_ingr = document.getElementById("search_ingredient");
    let input_tag = document.getElementById("search_tag");

    let checkbox_ingr = document.getElementById("checkbox_ingredient");
    let checkbax_tag = document.getElementById("checkbox_tag");


    function removeAllChild(parent) {
        while (parent.firstChild) {
            parent.removeChild(parent.firstChild);
        }
    }


    for(let ingredient in vardataIngr){

        let input = document.createElement('input')
        input.type = "checkbox";
        input.name = vardataIngr[ingredient].nomIngredient;

        let label = document.createElement('label');
        label.htmlFor = vardataIngr[ingredient].nomIngredient;
        label.innerHTML = vardataIngr[ingredient].nomIngredient;
        let br = document.createElement('br')

        checkbox_ingr.appendChild(input);
        checkbox_ingr.appendChild(label);
        checkbox_ingr.appendChild(br);
    }

    for(let tag in vardataTag){

        let input = document.createElement('input')
        input.type = "checkbox";
        input.name = vardataTag[tag].nomTag;

        let label = document.createElement('label');
        label.htmlFor = vardataTag[tag].nomTag;
        label.innerHTML = vardataTag[tag].nomTag;
        let br = document.createElement('br')

        checkbox_tag.appendChild(input);
        checkbox_tag.appendChild(label);
        checkbox_tag.appendChild(br);
    }



    input_ingr.addEventListener('input', function (){

        removeAllChild(checkbox_ingr);

        for (let ingredient in vardataIngr) {

            if(vardataIngr[ingredient].nomIngredient.toUpperCase().includes(input_ingr.value.toUpperCase())) {
                let input = document.createElement('input')
                input.type = "checkbox";
                input.name = vardataIngr[ingredient].nomIngredient;

                let label = document.createElement('label');
                label.htmlFor = vardataIngr[ingredient].nomIngredient;
                label.innerHTML = vardataIngr[ingredient].nomIngredient;
                let br = document.createElement('br')

                checkbox_ingr.appendChild(input);
                checkbox_ingr.appendChild(label);
                checkbox_ingr.appendChild(br);
            }
        }
    })

    input_tag.addEventListener('input', function (){

        removeAllChild(checkbox_tag);

        for (let tag in vardataTag) {

            if(vardataTag[tag].nomTag.toUpperCase().includes(input_tag.value.toUpperCase())) {
                let input = document.createElement('input')
                input.type = "checkbox";
                input.name = vardataTag[tag].nomTag;

                let label = document.createElement('label');
                label.htmlFor = vardataTag[tag].nomTag;
                label.innerHTML = vardataTag[tag].nomTag;
                let br = document.createElement('br')

                checkbox_tag.appendChild(input);
                checkbox_tag.appendChild(label);
                checkbox_tag.appendChild(br);
            }
        }
    })



})