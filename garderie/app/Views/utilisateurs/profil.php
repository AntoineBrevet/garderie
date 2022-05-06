<?= $this->extend('master') ?>

<?= $this->section('css') ?>

<link href="<?= base_url(); ?>/css/profil.css" rel="stylesheet">

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php
//var_dump($data)
?>
<a href="<?= base_url() ?>/utilisateursIndex" class="retour"> <img src="<?= base_url()  ?>/img/retour.png" alt=""></a><br>

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
        <?php $dateN = date("Y-m-d", strtotime($data['dateNaissanceParents'])) ?>
        <div> <label for="prenom">date de naissance</label>
            <input type="date" name="dateNaissanceParents" max="<?= date('Y-m-d', strtotime('-16 year')); ?>" value="<?= $dateN; ?>">

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
                                                        echo '0' . ($data['telParents']);
                                                        ?>">

        </div>

        <input type="submit" class="btnModif" value="Modifier le profil"><br>

    </form>
</section>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- Mettre le JS avec une balise script -->
<?= $this->endSection() ?>