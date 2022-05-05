<?= $this->extend('master') ?>

<?= $this->section('css') ?>

<link href="<?= base_url(); ?>/css/createEnfants.css" rel="stylesheet">

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="sec1">
    <h1>AJOUTER D'ENFANTS</h1>

    <form method="post">
        <div>
            <label for="nomEnfants">Nom</label>
            <input type="text" name="nomEnfants" id="nomEnfants">
        </div>
        <div>
            <label for="prenomEnfants">Prénom</label>
            <input type="text" name="prenomEnfants" id="prenomEnfants">
        </div>
        <div class="radios">
            <input type="radio" id="sexeEnfants" name="sexeEnfants" value="masculin" checked>
            <label for="sexe">Masculin</label>

            <input type="radio" id="sexeEnfants" name="sexeEnfants" value="feminin">
            <label for="sexe">Féminin</label>
        </div>
        <div>
            <label for="dateNaissanceEnfants">Date de naissance</label>
            <input type="date" min="<?=date('Y-m-d', strtotime('-18 year'));?>" max="<?=date('Y-m-d');?>" name="dateNaissanceEnfants" id="dateNaissanceEnfants">
        </div>
        <div>
            <label for="allergies">Allergies</label>
            <input type="text" name="allergies" id="allergies">
        </div>
        <div>
            <label for="medicaments">Médicaments</label>
            <input type="text" name="medicaments" id="medicaments">
        </div>
        <div class="submit">
            <input type="submit" value="Enregistrer">
        </div>
    </form>

    <a href="<?= base_url() ?>/showEnfants" class="retour"> <img src="<?= base_url()  ?>/img/retour.png" alt=""> Retour</a><br>
</section>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- Mettre le JS avec une balise script -->
<?= $this->endSection() ?>