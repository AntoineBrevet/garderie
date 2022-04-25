<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>create</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="<?= base_url(); ?>/css/style.css" rel="stylesheet">
    <script type="text/javascript" src="<?= base_url(); ?>/js/main.js"></script>
</head>

<body>
    <div class="input-field col s12">
        <label for="email" class="active" style="color: black;">titre</label>
        <input class="validate" type="text" value="" name="titre" placeholder="creche bois-guillaume" required="">
    </div>

    <div class="input-field col s12">
        <label for="naissance" class="active" style="color: black;">Date de debut</label>
        <input type="text" class="datepicker" name="debut" placeholder="10h-11h" required="">
    </div>

</body>

</html>