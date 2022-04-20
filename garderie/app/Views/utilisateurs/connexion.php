<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Connexion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="<?= base_url(); ?>/css/style.css" rel="stylesheet">
    <script type="text/javascript" src="<?= base_url(); ?>/js/main.js"></script>
</head>

<body>

    <div class="container" style="background: linear-gradient(115deg, #1f73b4, #57c5cd);">
        <div class="row">
            <div class="col s12 m12 l12" style="text-align:center; color:white;">
                <i class="large material-icons">add_circle</i>
                <h1>connexion</h1>
                <p>Bienvenue sur la page de Connexion, Connecte toi des maintenant!</p>
            </div>
        </div>
        <div class="row" id="blanc">
            <div class="col l12 m12 s12" id="rectangle">
                <form method="GET">

                    <div class="input-field col s12">
                        <label for="email" class="active" style="color: black;">Email</label>
                        <input class="validate" type="email" value="" name="email" placeholder="ex: Dupond1990@gmail.com" required="">
                    </div>

                    <div class="input-field col s12">
                        <label for="Password" class="active" style="color: black;">Password</label>
                        <input class="validate" type="Password" value="" name="Password" id="p1" placeholder="Mot de Passe" required="">
                        <input class="validate" type="Password" placeholder="Mot de Passe" onfocus="validatePassword(document.getElementById('p1'), this);" oninput="validatePassword(document.getElementById('p1'), this);" required="">
                    </div>

                    <div class="input-field col s12">
                        <button class="btn waves-effect waves-light pulse" type="submit" name="action">Valider
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script type="text/javascript" src="js.js">
    </script>
</body>

</html>