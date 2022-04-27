<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <?php
    var_dump($data)
    ?>

    <section class="profil">
        <h2> le profil </h2><br>
        <form action="#" method="POST">

            <div>
                <label for="prenom">Nom:</label>
                <input type="nom" name="nom" value="<?php
                                                    echo ($data['nomPros']);
                                                    ?>">
            </div>
            <div>
                <label for="prenom">Prénom:</label>
                <input type="prenom" name="prenom" value="<?php
                                                            echo ($data['prenomPros']);
                                                            ?>">
            </div>
            </div>
            <div> <label for="prenom">date de naissance</label>
                <input type="text" name="password" value="<?php
                                                            echo ($data['dateNaissancePros']);
                                                            ?>">

            </div>
            </div>
            <div> <label for="prenom">Adresse</label>
                <input type="text" name="password" value="<?php
                                                            echo ($data['adressePros']);
                                                            ?>">

            </div>
            <div> <label for="prenom">nombres d'enfants</label>
                <input type="text" name="password" value="<?php
                                                            echo ($data['siret']);
                                                            ?>">

            </div>
            <div> <label for="prenom">Adresse E-mail:</label>
                <input type="email" name="email" value="<?php
                                                        echo ($data['mailPros']);
                                                        ?>">
            </div>
            </div>
            <div> <label for="prenom">numéro de télephone</label>
                <input type="text" name="password" value="<?php
                                                            echo ($data['telPros']);
                                                            ?>">

            </div>
            <div> <label for="prenom">Mot de Passe</label>
                <input type="text" name="password" value="<?php
                                                            echo ($data['mdpPros']);
                                                            ?>">
            </div>
            <label for="story">description:</label>

            <textarea id="story" name="story" rows="5" cols="33" value="<?php
                                                                        echo ($data['descriptionPros']);
                                                                        ?>">
</textarea>
            <input class="submit-button" type="submit" value="Modifier">

        </form>
    </section>
</body>

</html>