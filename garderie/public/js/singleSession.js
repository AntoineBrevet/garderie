var sessionInputDateDebut = document.querySelector(".sessionInputDateDebut");
var sessionInputDateFin = document.querySelector(".sessionInputDateFin");
var sessionInputSessionDebut = document.querySelector(".sessionInputSessionDebut");
var sessionInputSessionFin = document.querySelector(".sessionInputSessionFin");

sessionInputDateDebut.addEventListener("input", myFunction);
sessionInputDateFin.addEventListener("input", myFunction2);
sessionInputSessionDebut.addEventListener("input", myFunction3);
sessionInputSessionFin.addEventListener("input", myFunction4);

var ligne = document.querySelectorAll(".ligne");

// ligne.addEventListener("click", myFunction5);

function myFunction() {
    if (sessionInputDateDebut.value != "" && sessionInputDateFin.value != "" && sessionInputSessionDebut.value != "" && sessionInputSessionFin.value != "") {
        // ligne.click();  

        console.log("oui");
    }
}
function myFunction2() {
    if (sessionInputDateDebut.value != "" && sessionInputDateFin.value != "" && sessionInputSessionDebut.value != "" && sessionInputSessionFin.value != "") {
        console.log("test2")
    }
}
function myFunction3() {
    if (sessionInputDateDebut.value != "" && sessionInputDateFin.value != "" && sessionInputSessionDebut.value != "" && sessionInputSessionFin.value != "") {
        console.log("test3")
    }
}
function myFunction4() {
    if (sessionInputDateDebut.value != "" && sessionInputDateFin.value != "" && sessionInputSessionDebut.value != "" && sessionInputSessionFin.value != "") {
        console.log("test4")
    }
}



// function myFunction5() {
//     ligne.forEach(ligneKey => {
//         ligneKey.addEventListener('click', function handleClick() {
//             console.log("NON");
//             ligneKey.style.backgroundColor = "black";
//         });
//     });
// }

// ligne.forEach(ligneKey => {
//     ligneKey.addEventListener('click', function handleClick() {
//         console.log(ligneKey['cells'][4]['innerHTML']);
//         console.log(sessionInputDateDebut.value);
//         console.log(sessionInputDateFin.value);
//         console.log(ligneKey);
//         console.log(ligneKey['cells'][0]['innerHTML']);
//         // ligneKey.style.backgroundColor = "black";
//         if ((sessionInputDateDebut.value <= ligneKey['cells'][4]['innerHTML'] && sessionInputDateFin.value >= ligneKey['cells'][4]['innerHTML'])) {
//             console.log("yes");
//             if (){

//             }
//         }
//         if ((sessionInputDateDebut.value == ligneKey['cells'][4]['innerHTML'] && sessionInputSessionDebut.value == ligneKey['cells'][0]['innerHTML']) || (sessionInputDateDebut.value == ligneKey['cells'][4]['innerHTML'] && sessionInputSessionDebut.value == ligneKey['cells'][0]['innerHTML'])) {
//             ligneKey.style.backgroundColor = "black";
//         }
//     });
// });
