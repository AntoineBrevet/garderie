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
                                                    echo ($data['nomParents']);
                                                    ?>">
            </div>
            <div>
                <label for="prenom">Prénom:</label>
                <input type="prenom" name="prenom" value="<?php
                                                            echo ($data['prenomParents']);
                                                            ?>">
            </div>
            </div>
            <div> <label for="prenom">date de naissance</label>
                <input type="text" name="password" value="<?php
                                                            echo ($data['dateNaissanceParents']);
                                                            ?>">

            </div>
            </div>
            <div> <label for="prenom">Adresse</label>
                <input type="text" name="password" value="<?php
                                                            echo ($data['adresseParents']);
                                                            ?>">

            </div>
            <div> <label for="prenom">nombres d'enfants</label>
                <input type="text" name="password" value="<?php
                                                            echo ($data['nbr_enfants']);
                                                            ?>">

            </div>
            <div> <label for="prenom">Adresse E-mail:</label>
                <input type="email" name="email" value="<?php
                                                        echo ($data['mailParents']);
                                                        ?>">
            </div>
            </div>
            <div> <label for="prenom">numéro de télephone</label>
                <input type="text" name="password" value="<?php
                                                            echo ($data['telParents']);
                                                            ?>">

            </div>
            <div> <label for="prenom">Mot de Passe</label>
                <input type="text" name="password" value="<?php
                                                            echo ($data['mdpParents']);
                                                            ?>">

            </div>
            <input class="submit-button" type="submit" value="Modifier">

        </form>
    </section>
</body>

</html>