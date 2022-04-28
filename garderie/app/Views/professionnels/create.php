<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>create</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="<?= base_url(); ?>/css/stylePros.css" rel="stylesheet">
    <script type="text/javascript" src="<?= base_url(); ?>/js/main.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col s12 m12 l12" style="text-align:center; color:white;"><a href="<?= base_url(); ?>/professionnels">
                    <img src="<?= base_url();  ?>/img/garderie.png" width="250px" alt=""></a>
                <h3>crée ton Annonce</h3>
                <p>Bienvenue sur la page de Création d'annonce!</p>
            </div>
        </div>
        <div class="row" id="blanc">
            <div class="col l12 m12 s12" id="rectangle">
                <form method="post">
                    <div class="input-field col s6">
                        <label for="titre" class="active" style="color: black;">titre</label>
                        <input type="text" value="" name="Titre_Creneau" placeholder="ex: Creche bois-guillaume" required="">
                    </div>

                    <div class="input-field col s6">
                        <label for="date" class="active" style="color: black;">Date</label>
                        <input type="date" value="" name="date" placeholder="ex: choisissez une date" required="">
                    </div>

                    <div class="input-field col s6">
                        <label for="debut" class="active" style="color: black;">debut</label>
                        <input type="text" value="" name="debut" placeholder="ex: choisissez un debut" required="">
                    </div>

                    <div class="input-field col s6">
                        <label for="fin" class="active" style="color: black;">fin</label>
                        <input type="text" value="" name="fin" placeholder="ex: choisissez une fin" required="">
                    </div>

                    <div class="input-field col s6">
                        <label for="debut_session" class="active" style="color: black;">horaire de debut</label>
                        <input type="text" value="" name="debut_session" placeholder="ex: 7h" required="">
                    </div>
                    <div class="input-field col s6">
                        <label for="fin_session" class="active" style="color: black;">horaire de fin</label>
                        <input type="text" value="" name="fin_session" placeholder="ex: 19h" required="">
                    </div>
                    <div class="input-field col s6">
                        <label for="email" class="active" style="color: black;">nombres de places</label>
                        <input type="text" value="" name="nbr_place" placeholder="ex: Dupond1990@gmail.com" required="">
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

</body>

</html>