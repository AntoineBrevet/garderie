<?= $this->extend('master') ?>

<?= $this->section('css') ?>
<link href="<?= base_url(); ?>/css/showReservation.css" rel="stylesheet">
<!-- Mettre le CSS avec une balise link -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Mettre le content de la page -->
<section class="sec1">
    <h1><img src="<?= base_url() ?>/img/reserved.png" width="100px" alt=""><br> Mes réservations</h1>

    <?php
    foreach ($reservation as $reservations) { ?>
        <h3>Du <?= $reservations['debut_date_reservation']; ?> à <?= $reservations['debut_reservation']; ?>h au <?= $reservations['fin_date_reservation']; ?> à <?= $reservations['fin_reservation']; ?>h pour <?= $reservations['prenomEnfants']; ?> <?= $reservations['nomEnfants']; ?> avec <?= $reservations['prenomPros']; ?> <?= $reservations['nomPros']; ?> pour <?= $reservations['prixReservation']; ?>€</h3>
    <?php
    }
    ?>
</section>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- Mettre le JS avec une balise script -->
<?= $this->endSection() ?>