<?= $this->extend('masterPros') ?>

<?= $this->section('css') ?>
    <!-- Mettre le CSS avec une balise link -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php

foreach ($infos as $info) {
    echo $info['date_debut'] ." ". $info['debutSession']."h à " . $info['date_debut'] ." " .$info['finSession']."h /// ";
}
?>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <!-- Mettre le JS avec une balise script -->
<?= $this->endSection() ?>