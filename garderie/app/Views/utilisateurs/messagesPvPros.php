<?php
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>popup</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

</head>

<body>

<div class="center">

    <input type="checkbox" id="click">
    <label for="click" class="click-me"><i class="fa-solid fa-message"></i></label>
<div class="content">
    <div class="header">

        <h2>Messages Privés</h2>
        <label for="click" class="fas fa-times"></label>
        </div>

   <!-- <label for="click" class="fas fa-check"></label> -->
    <?php

    foreach ($contact as $contacts) {
?>


        <?php
        echo "<div class ='contactList' value='".$contacts['id_destinataire']."'>".$contacts['nomPros']." ".$contacts['prenomPros']."</div><input type='hidden'>";
?><br><?php
    }


    ?>
    <p>Contactez un professionnel pour démarrer une conversation</p>

    <div class="line"></div>


    <script>

        var toto = document.querySelectorAll('.contactList')


        toto.forEach(contactList => {
            contactList.addEventListener('click', function handleClick() {
                document.querySelectorAll('.contactList').style="display:none;"

var idPro = contactList.getAttribute('value')
                console.log(idPro)



            });
        });

    </script>
</div>
</div>

</body>

</html>





