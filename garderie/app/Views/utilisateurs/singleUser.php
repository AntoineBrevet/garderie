<?= $this->extend('master') ?>

<?= $this->section('css') ?>
<link href="<?= base_url(); ?>/css/indexUser.css" rel="stylesheet">

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="single">
    <div>
        <label for="prenom">Nom</label>
        <?php
        echo ($data['nomPros']);
        ?>
    </div>
    <br>
    <div> <label for="prenom">date de naissance</label>
        <?php
        echo ($data['dateNaissancePros']);
        ?>

    </div>
    <br>
    <div> <label for="prenom">Adresse</label>
        <?php
        echo ($data['adressePros']);
        ?>

    </div>
    <br>
    <div> <label for="prenom">Adresse E-mail</label>
        <?php
        echo ($data['mailPros']);
        ?>
    </div>
    <br>
    <div> <label for="prenom">numéro de télephone</label> +33
        <?php
        echo ($data['telPros']);
        ?>

    </div>
    <hr>
    <div class="description"> <label for="prenom">description</label>
        <?php
        echo ($data['descriptionPros']);
        ?>
    </div>
    <br>
    <div class="payement">
        <a href="<?= base_url(); ?>/Payement">Payement</a>
    </div>
</section>


<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- Mettre le JS avec une balise script -->
<?= $this->endSection() ?>