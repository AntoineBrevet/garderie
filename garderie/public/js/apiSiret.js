// Create a request variable and assign a new XMLHttpRequest object to it.
var request = new XMLHttpRequest()

// Open a new connection, using the GET request on the URL endpoint
request.open('GET', 'https://www.data.gouv.fr/fr/datasets/base-sirene-des-entreprises-et-de-leurs-etablissements-siren-siret/', true)

request.onload = function () {
    // Begin accessing JSON data here
    var data = JSON.parse(this.response)

    data.forEach(movie => {
        // Log each movie's title
        console.log(movie.title)
    })
}

// Send request
request.send()