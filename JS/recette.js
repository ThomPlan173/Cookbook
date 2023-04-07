document.addEventListener('DOMContentLoaded', function (){

    let number = document.getElementById("personne");
    let quantites = document.getElementsByClassName("quantite");

    for(let quant of quantites){
        var q = quant.innerHTML;


    }
    number.addEventListener('change', function (event){
        for(let quant of quantites){
            var q = quant.innerHTML;

        }
    })
})