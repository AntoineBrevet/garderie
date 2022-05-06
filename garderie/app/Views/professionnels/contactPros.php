<?= $this->extend('masterPros') ?>

<?= $this->section('css') ?>
<link href="<?= base_url(); ?>/css/messages-contact.css" rel="stylesheet">
<!-- Mettre le CSS avec une balise link -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Mettre le content de la page -->
<section class="sec1">
    <h1> <img src="<?= base_url() ?>/img/contact.png" width="100px" alt="">Contacter mes clients</h1>
    <div class='my-conatcts'>

        <div class="names">
            <?php

            foreach ($contact as $contacts) {

                echo "<a href='" . base_url() . "/messagesPros/" . $contacts['id_auteur'] . "'> " . $contacts['nomParents'] . " " . $contacts['prenomParents'] . "</a>";
            }


            ?></div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- Mettre le JS avec une balise script -->
<?= $this->endSection() ?>