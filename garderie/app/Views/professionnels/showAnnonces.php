<?= $this->extend('masterPros') ?>

<?= $this->section('css') ?>
<link href="<?= base_url(); ?>/css/showAnnonces.css" rel="stylesheet">
<!-- Mettre le CSS avec une balise link -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="sec1">
    <div class="annonces">
        <h1><img src="<?= base_url() ?>/img/annonce.png" width="250px" alt="">Mes Annonces</h1>
        <div class="annonce">
            <?php

            foreach ($infos as $info) {
                echo $info['date_debut'] . " " . $info['debutSession'] . "h à " . $info['date_debut'] . " " . $info['finSession'] . "h /// ";
            }
            ?>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- Mettre le JS avec une balise script -->
<?= $this->endSection() ?>