<?= $this->extend('master') ?>

<?= $this->section('css') ?>

<link href="<?= base_url(); ?>/css/profil.css" rel="stylesheet">

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php
//var_dump($data)
?>
<form class="retour">
    <a href="<?= base_url() ?>/utilisateursIndex" class="retour"> <img src="<?= base_url()  ?>/img/retour.png" alt=""></a><br>
</form>
<section class="sec1">

    <h2> <img src="<?= base_url()  ?>/img/planche.png" alt=""> le profil </h2>
    <form action="" method="POST">


        <div>
            <label for="prenom">Nom</label>
            <input type="nom" name="nomParents" value="<?php
                                                        echo ($data['nomParents']);
                                                        ?>">
        </div>

        <div> <label for="prenom">Prenom</label>

            <input type="prenom" name="prenomParents" value="<?php
                                                                echo ($data['prenomParents']);
                                                                ?>">
        </div>
        <div> <label for="prenom">date de naissance</label>
            <input type="date" name="dateNaissanceParents" value="<?php
                                                                    echo ($data['dateNaissanceParents']);
                                                                    ?>">

        </div>

        <div> <label for="prenom">Adresse</label>
            <input type="text" name="adresseParents" value="<?php
                                                            echo ($data['adresseParents']);
                                                            ?>">

        </div>
        <div> <label for="prenom">nombres d'enfants</label>
            <input type="text" name="nbr_enfants" value="<?php
                                                            echo ($data['nbr_enfants']);
                                                            ?>">

        </div>
        <div> <label for="prenom">Adresse E-mail</label>
            <input type="email" name="mailParents" value="<?php
                                                            echo ($data['mailParents']);
                                                            ?>">
        </div>
        </div>
        <div> <label for="prenom">numéro de télephone</label>
            <input type="text" name="telParents" value="<?php
                                                        echo ($data['telParents']);
                                                        ?>">

        </div>
        <div> <label for="prenom">Mot de Passe</label>
            <input type="text" name="mdpParents" value="<?php
                                                        echo ($data['mdpParents']);
                                                        ?>">

        </div>
        <input type="submit" class="btnModif" value="Modifier le profil"><br>

    </form>
</section>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- Mettre le JS avec une balise script -->
<?= $this->endSection() ?>