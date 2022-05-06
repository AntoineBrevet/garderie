

let start1 =document.querySelector("#start")
let stop1 = document.querySelector("#stop")

let start2 = document.querySelector("#dateDebut")
let stop2 = document.querySelector("#dateFin")

let start3 = document.querySelector('#sessionInputDateDebut')
let stop3 = document.querySelector('#sessionInputDateFin')

document.addEventListener('click', blockDate)
document.addEventListener('click', blockDate2)

function blockDate() {
    stop1.min = start1.value 
    start1.max = stop1.value
}

function blockDate2() {
    stop2.min = start2.value 
    start2.max = stop2.value
}

