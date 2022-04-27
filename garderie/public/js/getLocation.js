const button = document.querySelector('#buttonHidden')
const p = document.querySelector('#buttonHidden')
const v = document.querySelector('#submitLocalisation')
button.addEventListener('click', () => {
        p.style.display = 'none'
        v.style.display = 'block'
})



function getLocation(){
    if (navigator.geolocation){
        navigator.geolocation.getCurrentPosition(showPosition,ShowError);
    }
}
function showPosition(position){

    document.getElementById("latitudeHidden").value = position.coords.latitude;
    document.getElementById("longitudeHidden").value = position.coords.longitude;

}

function ShowError(error){
    switch(error.code){
        case error.PERMISSION_DENIED:
            alert("Activez votre localisation pour remplir le formulaire");
            location.reload()
            break;
    }
}