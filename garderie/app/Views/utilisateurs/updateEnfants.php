<?= $this->extend('master') ?>

<?= $this->section('css') ?>
<!-- Mettre le CSS avec une balise link -->
<link href="<?= base_url(); ?>/css/updateEnfants.css" rel="stylesheet">

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php
//var_dump($data);
?>
<section class="sec1">
    <h1>UPDATE ENFANTS</h1>

    <form method="post">
        <div>
            <label for="nomEnfants">Nom</label>
            <input type="text" name="nomEnfants" id="nomEnfants" value="<?= $data['nomEnfants'] ?>">
        </div>
        <div>
            <label for="prenomEnfants">Prénom</label>
            <input type="text" name="prenomEnfants" id="prenomEnfants" value="<?= $data['prenomEnfants'] ?>">
        </div>
        <div class="radios">
            <input type="radio" id="sexeEnfants" name="sexeEnfants" value="masculin" <?php if ($data['sexeEnfants'] == "masculin") {
                                                                                            echo ("checked");
                                                                                        } ?>>
            <label for="sexe">Masculin</label>

            <input type="radio" id="sexeEnfants" name="sexeEnfants" value="feminin" <?php if ($data['sexeEnfants'] == "feminin") {
                                                                                        echo ("checked");
                                                                                    } ?>>
            <label for="sexe">Féminin</label>
        </div>
        <div>
            <label for="dateNaissanceEnfants">Date de naissance</label>
            <input type="date" name="dateNaissanceEnfants" id="dateNaissanceEnfants" value="<?= $data['dateNaissanceEnfants'] ?>">
        </div>
        <div>
            <label for="allergies">Allergies</label>
            <input type="text" name="allergies" id="allergies" value="<?= $data['allergies'] ?>">
        </div>
        <div>
            <label for="medicaments">Médicaments</label>
            <input type="text" name="medicaments" id="medicaments" value="<?= $data['medicaments'] ?>">
        </div>
        <div class="submit">
            <input type="submit">
        </div>
    </form>

    <a href="<?= base_url() ?>/showEnfants" class="retour"> <img src="<?= base_url()  ?>/img/retour.png" alt=""> Retour</a><br>
</section>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- Mettre le JS avec une balise script -->
<?= $this->endSection() ?>