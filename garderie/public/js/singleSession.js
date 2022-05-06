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

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
} 

$(function() {

    var $form = $(".require-validation");

    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
            inputSelector = ['input[type=text]'].join(', '),
            $inputs = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('div.error'),
            valid = true;
        $errorMessage.addClass('hide');

        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
            var $input = $(el);
            if ($input.val() === '') {
                $input.parent().addClass('has-error');
                $errorMessage.removeClass('hide');
                e.preventDefault();
            }
        });
        console.log(Stripe);
        if (!$form.data('cc-on-file')) {
            e.preventDefault();
            Stripe.setPublishableKey($form.data('stripe-publishable-key'));
            Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);
        }

    });

    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];

            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }

});