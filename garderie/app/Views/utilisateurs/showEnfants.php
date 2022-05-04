<?= $this->extend('master') ?>

<?= $this->section('css') ?>
<link href="<?= base_url(); ?>/css/showEnfants.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="sec1">
    <h1 class="title">SHOW ENFANTS</h1>
    <div class="sec1-div">
        <form>
            <input class="retour" type="button" value="Retour" onclick="history.go(-1)">
        </form>
        <a href="<?= base_url(); ?>/createEnfants"><img src="<?= base_url() ?>/img/ajoute-d'enfants.png" width="100px" alt=""> Ajouter un enfant</a><br>
        <div class="babies-list">
            <h1>Liste des enfants</h1>
            <?php
            foreach ($data as $datas) {
                $dateOfBirth = $datas["dateNaissanceEnfants"];
                $today = date("Y-m-d");
                $diff = date_diff(date_create($dateOfBirth), date_create($today));
                $age = $diff->format('%y');

            ?>

                <div class="baby-infos">

                    <div>
                        <h4> Nom :</h4>
                        <p><?= $datas["nomEnfants"] ?></p>

                        <h4>Prénom :</h4>
                        <p><?= $datas["prenomEnfants"] ?></p>
                    </div>
                    <div>
                        <h4> Date de naissance :</h4>
                        <p><?= $datas["dateNaissanceEnfants"] ?></p>
                    </div>
                    <div>
                        <h4> Age :</h4>
                        <p><?= $age ?> ans</p>
                    </div>
                    <div>
                        <h4> Sexe :</h4>
                        <p> <?= $datas["sexeEnfants"] ?></p>
                    </div>
                    <div>
                        <h4>Allergies :</h4>
                        <p><?= $datas["allergies"] ?></p>
                    </div>
                    <div>
                        <h4> Médicaments :</h4>
                        <p> <?= $datas["medicaments"] ?></p>
                    </div>
                    <div class="options-btn">
                        <a href="<?= base_url() ?>/updateEnfants/<?= $datas["id"] ?>">Modifier l'enfant</a><br>
                        <a href="<?= base_url() ?>/deleteEnfants/<?= $datas["id"] ?>">Supprimer l'enfant</a><br>
                    </div>
                </div>

            <?php
            }
            ?>
        </div>
    </div>





</section>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- Mettre le JS avec une balise script -->
<?= $this->endSection() ?>