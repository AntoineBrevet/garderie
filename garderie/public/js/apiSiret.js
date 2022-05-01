function verif(){

    let query = document.getElementById('query').value
    fetch('https://entreprise.data.gouv.fr/api/sirene/v1/siret/' + query)
        .then(res => res.json())
        .then(function (data){
            console.log(data['etablissement']['siret'])
            document.getElementById('query').style = "border-color: green;"
            document.getElementById('spanVerif').innerHTML = "numéro de siret valide"

        })

        .catch(function () {
            console.log("error");
            document.getElementById('query').style = "border-color: red;"
            document.getElementById('spanVerif').innerHTML = "numéro de siret invalide"

        });
}