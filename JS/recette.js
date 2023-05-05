document.addEventListener('DOMContentLoaded', function (){

    let input_number = document.getElementById("personne");
    let quantites = document.getElementsByClassName("quantite");
    let q = [];

    for(let i = 0; i < quantites.length; i++){
        q.push(quantites[i].innerHTML);
        quantites.innerHTML = q[i] * input_number.value;

    }

    input_number.addEventListener('input', function (event){
        for(let i = 0; i < quantites.length; i++){

            quantites[i].innerHTML = q[i] * input_number.value;

        }
    })
})