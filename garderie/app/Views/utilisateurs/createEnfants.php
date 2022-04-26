<?= $this->extend('master') ?>

<?= $this->section('css') ?>
<!-- Mettre le CSS avec une balise link -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php
    var_dump(session("id"));
?>

<p>CREATE ENFANTS</p>

<form method="post">
    <div>
        <label for="nomEnfants">Nom</label>
        <input type="text" name="nomEnfants" id="nomEnfants">
    </div>
    <div>
        <label for="prenomEnfants">Prénom</label>
        <input type="text" name="prenomEnfants" id="prenomEnfants">
    </div>
    <div>
        <input type="radio" id="sexeEnfants" name="sexeEnfants" value="masculin" checked>
        <label for="sexe">Masculin</label>
    </div>
    <div>
        <input type="radio" id="sexeEnfants" name="sexeEnfants" value="feminin">
        <label for="sexe">Féminin</label>
    </div>
    <div>
        <label for="dateNaissanceEnfants">Date de naissance</label>
        <input type="date" name="dateNaissanceEnfants" id="dateNaissanceEnfants">
    </div>
    <div>
        <label for="allergies">Allergies</label>
        <input type="text" name="allergies" id="allergies">
    </div>
    <div>
        <label for="medicaments">Médicaments</label>
        <input type="text" name="medicaments" id="medicaments">
    </div>
    <div>
        <input type="submit">
    </div>
</form>

<a href="<?= base_url() ?>/showEnfants">Retour</a><br>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- Mettre le JS avec une balise script -->
<?= $this->endSection() ?>