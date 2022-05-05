<?= $this->extend('masterPros') ?>

<?= $this->section('css') ?>
    <!-- Mettre le CSS avec une balise link -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php


foreach ($infos as $info) {
    echo $info['jour'];
}
?>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <!-- Mettre le JS avec une balise script -->
<?= $this->endSection() ?>