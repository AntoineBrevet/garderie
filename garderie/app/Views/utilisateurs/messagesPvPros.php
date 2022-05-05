<?php
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
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
            <div class="containerAllContact">


                <!-- <label for="click" class="fas fa-check"></label> -->
                <div class="containerContactList">
                    <?php
                    foreach ($contact as $contacts) {
                        echo "<span class ='contactList' value='" . $contacts['id_destinataire'] . "'>" . $contacts['nomPros'] . " " . $contacts['prenomPros'] . "</span><br><br>";
                    }
                    ?>
                </div>

                <p class="contactPro">Contactez un professionnel pour démarrer une conversation</p>

                <div class="listMessages"></div>

                <div class="containerMessages"><textarea name='message' class='message'></textarea><br><input type='submit' name='envoyer' class='envoyer'></div>

                <span class="retourButton">Voir les contacts</span>



                <!-- <div class="line"></div> -->


                <script>

                    var contactList = document.querySelectorAll('.contactList');
                    var containerContactList = document.querySelector('.containerContactList');
                    var contactPro = document.querySelector('.contactPro');
                    var containerMessages = document.querySelector('.containerMessages');
                    var retourButton = document.querySelector('.retourButton');
                    var listMessages = document.querySelector('.listMessages');
                    var envoyer = document.querySelector('.envoyer');
                    var message = document.querySelector('.message');
                    var allmessages = <?= json_encode($allmessages); ?>;

                    containerMessages.style.display = 'none';
                    retourButton.style.display = 'none';

                    contactList.forEach(contactListKey => {
                        contactListKey.addEventListener('click', function handleClick() {
                            retourButton.style.display = 'block';
                            containerContactList.style.display = 'none';
                            contactPro.style.display = 'none';
                            containerMessages.style.display = 'block';
                            listMessages.style.display = 'block';
                            listMessages.innerHTML = "";
                            var idPro = contactListKey.getAttribute('value')
                            console.log(idPro);
                            for (var i = 0; i < allmessages.length; i++) {
                                if (allmessages[i]['statut'] == "parent") {
                                    if (allmessages[i]['id_destinataire'] == idPro) {
                                        listMessages.innerHTML += "<p class='parentP'>" + allmessages[i]['contenu'] + "</p>"
                                    }
                                } else if (allmessages[i]['statut'] == "pro") {
                                    if (allmessages[i]['id_auteur'] == idPro) {
                                        listMessages.innerHTML += "<p class='proP'>" + allmessages[i]['contenu'] + "</p>"
                                    }
                                }
                            }

                            envoyer.addEventListener('click', function handleClick() {
                                if (message.value != "") {
                                    listMessages.innerHTML += "<p class='parentP'>" + message.value + "</p>";
                                    var idAuteur = <?= session("id") ?>;

                                    $.ajax({
                                        type: "POST",
                                        url: urlAjaxMessage,
                                        data: {
                                            "id_auteur": idAuteur,
                                            "id_destinataire": idPro,
                                            "contenu": message.value,
                                            "statut": "parent"
                                        },

                                    });
                                    message.value = "";
                                }
                            });
                        });
                    });

                    retourButton.addEventListener('click', function handleClick() {
                        retourButton.style.display = 'none';
                        containerContactList.style.display = 'block';
                        contactPro.style.display = 'block';
                        containerMessages.style.display = 'none';
                        listMessages.style.display = 'none';
                        message.value = "";
                    });
                </script>
            </div>
        </div>
    </div>

</body>

</html>