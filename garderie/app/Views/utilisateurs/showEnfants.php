<?= $this->extend('master') ?>

<?= $this->section('css') ?>
<link href="<?= base_url(); ?>/css/showEnfants.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="sec1">
    <h1 class="title">SHOW ENFANTS</h1>
    <div class="sec1-div">
        <a href="<?= base_url(); ?>/createEnfants"><img src="<?= base_url() ?>/img/ajoute-d'enfants.png" width="100px" alt=""> Ajouter un enfant</a><br>
        <?php
        foreach ($data as $datas) {
            $dateOfBirth = $datas["dateNaissanceEnfants"];
            $today = date("Y-m-d");
            $diff = date_diff(date_create($dateOfBirth), date_create($today));
            $age = $diff->format('%y');
            var_dump($datas);
        ?>
            <h1>ID : <?= $datas["id"] ?></h1>
            <h3>Nom : <?= $datas["nomEnfants"] ?></h3>
            <h3>Prénom : <?= $datas["prenomEnfants"] ?></h3>
            <p>Date de naissance : <?= $datas["dateNaissanceEnfants"] ?></p>
            <p>Age : <?= $age ?> ans</p>
            <p>Sexe : <?= $datas["sexeEnfants"] ?></p>
            <p>Allergies : <?= $datas["allergies"] ?></p>
            <p>Médicaments : <?= $datas["medicaments"] ?></p>
            <a href="<?= base_url() ?>/updateEnfants/<?= $datas["id"] ?>">Modifier l'enfant</a><br>
            <a href="<?= base_url() ?>/deleteEnfants/<?= $datas["id"] ?>">Supprimer l'enfant</a><br>
        <?php
        }
        ?>
    </div>





</section>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- Mettre le JS avec une balise script -->
<?= $this->endSection() ?>