<?= $this->extend('master') ?>

<?= $this->section('css') ?>
<!-- Mettre le CSS avec une balise link -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php
var_dump($data);
?>

<h1>Page Utilisateur</h1>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- Mettre le JS avec une balise script -->
<?= $this->endSection() ?>