<?= $this->extend('master') ?>

<?= $this->section('css') ?>
<link href="<?= base_url(); ?>/css/indexUser.css" rel="stylesheet">

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="single">
    <div>
        <img src="<?= base_url() ?>/img/user-single-profil.png" alt="">

        <label for="prenom">Nom</label>
        <div class="nom">
            <?php
            echo ($data['nomPros']);
            ?>
        </div>
    </div>
    <br>
    <div class="row-contents">
        <div> <img src="<?= base_url() ?>/img/ddn.png" alt="">
            <label for="ddn">date de naissance</label>
            <div class="ddn">
                <?php
                echo ($data['dateNaissancePros']);
                ?>
            </div>
        </div>

        <div> <img src="<?= base_url() ?>/img/adresse1.png" alt="">
            <label for="adresse">Adresse</label>
            <div class="adresse">
                <?php
                echo ($data['adressePros']);
                ?>
            </div>

        </div>
    </div>
    <br>
    <div class="row-contents">
        <div> <img src="<?= base_url() ?>/img/email1.png" alt="">
            <label for="email">Adresse E-mail</label>
            <div class="email">
                <?php
                echo ($data['mailPros']);
                ?>
            </div>
        </div>
        <br>
        <div> <img src="<?= base_url() ?>/img/tel1.png" alt="">
            <label for="tel">numéro de télephone</label>
            <div class="tel"> +33
                <?php
                echo ($data['telPros']);
                ?>
            </div>
        </div>
    </div>
    <hr>
    <div class="description"> <img src="<?= base_url() ?>/img/desc1.png" alt="">
        <label for="desc">description</label>
        <div class="desc">
            <?php
            echo ($data['descriptionPros']);
            ?>
        </div>
    </div>
    <br>
    <div class="message">
        <a href="<?= base_url(); ?>/messages/<?=$data['id']?>">Contacter</a>
    </div>
    <div class="payement">
        <a href="<?= base_url(); ?>/Payement">Payement</a> <img src="<?= base_url() ?>/img/Payement.png" alt="">
    </div>
</section>


<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- Mettre le JS avec une balise script -->
<?= $this->endSection() ?>