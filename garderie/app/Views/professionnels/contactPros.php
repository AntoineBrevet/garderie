<?= $this->extend('masterPros') ?>

<?= $this->section('css') ?>
    <!-- Mettre le CSS avec une balise link -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <!-- Mettre le content de la page -->

<?php

foreach ($contact as $contacts) {

    echo "<a href='". base_url()."/messagesPros/". $contacts['id_auteur']."'>".$contacts['nomParents']." ".$contacts['prenomParents']."</a>";

}


?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <!-- Mettre le JS avec une balise script -->
<?= $this->endSection() ?>