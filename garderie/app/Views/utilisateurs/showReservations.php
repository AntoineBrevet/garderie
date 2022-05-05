<?= $this->extend('master') ?>

<?= $this->section('css') ?>
<!-- Mettre le CSS avec une balise link -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Mettre le content de la page -->
<h1>Mes réservations :</h1>

<?php
foreach ($reservation as $reservations) { ?>
    <p>Du <?= $reservations['debut_date_reservation']; ?> à <?= $reservations['debut_reservation']; ?>h au <?= $reservations['fin_date_reservation']; ?> à <?= $reservations['fin_reservation']; ?>h pour <?= $reservations['prenomEnfants']; ?> <?= $reservations['nomEnfants']; ?> avec <?= $reservations['prenomPros']; ?> <?= $reservations['nomPros']; ?></p>

<?php
}
?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- Mettre le JS avec une balise script -->
<?= $this->endSection() ?>