<?= $this->extend('masterPros') ?>

<?= $this->section('css') ?>

<link href="<?= base_url(); ?>/css/profilPro.css" rel="stylesheet">

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php
//var_dump($data)
?>
<section class="sec1">

    <h2><img src="<?= base_url()  ?>/img/planche.png" alt=""> le profil </h2><br>
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
        <div> <label for="prenom">Siret</label>
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
        <div>
            <label for="story">description:</label>

            <textarea id="story" name="story" rows="5" cols="33" value="<?php
                                                                        echo ($data['descriptionPros']);
                                                                        ?>">
</textarea>
        </div>
        <div class="submit-button"><button type="submit" value="">Modifier</button></div>

    </form>
</section>
<?= $this->endSection() ?>