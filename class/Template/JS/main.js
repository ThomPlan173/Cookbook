document.addEventListener('DOMContentLoaded', function () {

    let container = document.getElementById("content_bouton_header")

    let elements = container.getElementsByClassName("button_header")

    for(let elem of elements){

        elem.addEventListener('mousemove', e=> {
            elem.style.backgroundColor = "cornflowerblue"
        })

        elem.addEventListener('mouseout', function () {
            elem.style.backgroundColor = "powderblue"
        })

    }
})