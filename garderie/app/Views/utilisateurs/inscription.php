<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inscription</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="<?= base_url(); ?>/css/style.css" rel="stylesheet">
  <script type="text/javascript" src="<?= base_url(); ?>/js/main.js"></script>
  <script type="text/javascript" src="<?= base_url(); ?>/js/mapInscription.js"></script>

</head>

<body>

  <div class="container">
    <div class="row">
      <div class="col s12 m12 l12" style="text-align:center; color:white;"><a href="<?= base_url(); ?>/">
          <img src="<?= base_url();  ?>/img/garderie.png" width="250px" alt=""></a>
        <h1>Inscription</h1>
        <p>Bienvenue sur la page d'inscription, veuillez remplir les informations ci-dessous</p>
      </div>
    </div>
    <div class="row" id="blanc">
      <div class="col l12 m12 s12" id="rectangle">
        <form method="post" autocomplete="off">

          <div class="input-field col s6">
            <label for="prenom" class="active" style="color: black;">Prénom</label>
            <input class="validate invalid" name="prenomParents" type="text" value="" id="prenomParents" placeholder="François" required="">
          </div>

          <div class="input-field col s6">
            <label for="nom" class="active" style="color: black;">Nom de famille</label>
            <input class="validate invalid" type="text" value="" name="nomParents" id="nomParents" placeholder="Pignon" required="" text-capitalize="">
          </div>

          <div class="input-field col s6">
            <label for="tel" class="active" style="color: black;">numéro de telephone</label>
            <input class="validate" type="text" value="" name="telParents" id="telParents" placeholder="ex: 06.18.99.65.32" required="">
          </div>

          <div class="input-field col s6">
            <label for="naissance" class="active" style="color: black;">Date de naissance</label>
            <input type="date" min="1900-01-01" max="<?= date('Y-m-d', strtotime('-16 year')); ?>" id="datepicker" class="datepicker" name="dateNaissanceParents" placeholder="10/02/1980" required>
          </div>

          <div class="input-field col s12">
            <label for="adresse" class="active" style="color: black;">Adresse</label>
            <input type="text" class="text" placeholder="1 rue de Paris 75000" name='address' id="location">
          </div>

          <div class="map" id="map" style="display:none;">
          </div>

          <div class="input-field col s12">
            <label for="email" class="active" style="color: black;">Email</label>
            <input class="validate" type="email" value="" name="mailParents" placeholder="ex: Dupond1990@gmail.com" required>

          </div>

          <div class="input-field col s12">
            <label for="Password" class="active" id="labelPassword" style="color: black;">Password</label>
            <p id='message' style="color: black;"></p>
            <input class="validate" type="Password" name="mdpParents" id="p1" placeholder="Mot de Passe" required="">

          </div>
          <div class="input-field col s12">
            <input class="validate" type="Password" value="" placeholder="Mot de Passe" onfocus="validatePassword(document.getElementById('p1'), this);" oninput="validatePassword(document.getElementById('p1'), this);" required="">
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
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHIY60MQ8Vyb5e7bM4P4_i5HsIcTr-kHw&libraries=places&callback=initMap&solution_channel=GMP_QB_addressselection_v1_cABC" async defer></script>

  
  </script>
</body>

</html>

<script type="text/javascript">
  var telephone = document.getElementById('telParents')
  var mdp = document.getElementById('p1')
  mdp.addEventListener('click', verifyPassword)

  mdp.addEventListener('input', verifyPassword)
  telephone.addEventListener('focusout', checknum)

  // verif du numero de telephone 
  function checknum() {
    var num = telephone.value;
    var valide = /^0[1-7]\d{8}$/;

    if (valide.test(num)) {
      telephone.classList.add('valid');
      telephone.classList.remove('invalid');

    } else {
      telephone.classList.add('invalid');
      telephone.classList.remove('valid');
    }
  }

  const msg = document.getElementById("message")

  function verifyPassword() {
    var pw = mdp.value;
    console.log(pw.length)

    //check empty password field  
    if (pw.length < 6) {
      msg.innerHTML = "minimum 6 caracteres";           
    }else   {
      msg.innerHTML = "";           
    }
  }
</script> 