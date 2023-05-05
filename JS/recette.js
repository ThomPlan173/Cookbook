document.addEventListener('DOMContentLoaded', function (){

    let number = document.getElementById("personne");
    let quantites = document.getElementsByClassName("quantite");

    for(let quant of quantites){
        var q = quant.innerHTML;
        quanr.innerHTML = q * number.value;

    }
    number.addEventListener('input', function (event){
        for(let quant of quantites){
            var q = quant.innerHTML;
            quanr.innerHTML = q * number.value;

        }
    })
})