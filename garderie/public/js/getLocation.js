function getLocation(){
    if (navigator.geolocation){
        navigator.geolocation.getCurrentPosition(showPosition,ShowError);
    }
}
function showPosition(position){

    var ajaxPath = urlAjax + "/query"; // page qui fait le SQL

    console.log(position.coords.latitude)
    console.log(position.coords.longitude)

    $.ajax({
        type: "POST",
        url: ajaxPath,
        data: {
            "longitude": position.coords.longitude, // on recupere l'id du CV pour pouvoir le supprimer
            "latitude": position.coords.latitude
        },
        success: function (response) {
            alert('CV Supprimé');
        }

    });


}

function ShowError(error){
    switch(error.code){
        case error.PERMISSION_DENIED:
            alert("Activez votre localisation pour remplir le formulaire");
            location.reload()
            break;
    }
}