<?= $this->extend('masterPros') ?>

<?= $this->section('css') ?>
<link href="<?= base_url(); ?>/css/showAnnonces.css" rel="stylesheet">
<!-- Mettre le CSS avec une balise link -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="sec1">
    <?php


    foreach ($infos as $info) {
        echo "Vous avez : " . $info['jour'] . " Annonces ";
    }
    ?>
</section>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- Mettre le JS avec une balise script -->
<?= $this->endSection() ?>