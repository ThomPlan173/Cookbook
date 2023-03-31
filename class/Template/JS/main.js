document.addEventListener('DOMContentLoaded', function () {

    let container = document.getElementById("content_bouton_header")

    let elements = container.getElementsByTagName("button")

    for(let elem of elements){

        elem.addEventListener('mousemove', e=> {
            elem.style.backgroundColor = "#3a3a3a"
        })

        elem.addEventListener('mouseout', function () {
            elem.style.backgroundColor = "black"
        })

    }
})