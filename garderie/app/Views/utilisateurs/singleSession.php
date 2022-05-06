<?= $this->extend('master') ?>

<?= $this->section('css') ?>
<link href="<?= base_url(); ?>/css/singleSession.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Mettre le content de la page -->
<section class="containerSession">

    <div class="container">
        <h1>Réservez une place pour votre enfant</h1>
        <form method="post">
            <div class="select-enfant">
                <label for="list">Sélectionnez un enfant : </label>
                <select name="list" id="list">
                    <?php foreach ($enfants as $enfant) {
                        echo ("<option value=" . $enfant['id'] . ">" . $enfant['nomEnfants'] . " " . $enfant['prenomEnfants'] . "</option>");
                    } ?>
                </select><br><br>
            </div>
            <div class="date-debut">
                <label for="date">Date de début : </label>
                <input type="date" value="" name="date_debut" placeholder="ex: choisissez une date" required="" class="sessionInputDateDebut">
            </div>
            <div class="date-fin">
                <label for="date">Date de fin : </label>
                <input type="date" value="" name="date_fin" placeholder="ex: choisissez une date" required="" class="sessionInputDateFin">
            </div>
            <div class="h-debut">
                <label for="debut_session">Horaire de debut : </label>
                <input type="text" value="" name="debut_session" placeholder="ex: 7h" required="" class="sessionInputSessionDebut">
            </div>
            <div class="h-fin">
                <label for="fin_session">Horaire de fin : </label>
                <input type="text" value="" name="fin_session" placeholder="ex: 19h" required="" class="sessionInputSessionFin">
            </div>
            <div class="reserver">
                <button type="submit" name="action">Réserver
                </button>
            </div>
        </form>
        <div class="scroll-table">
            <table>
                <thead>
                    <tr>
                        <th>Début du créneau</th>
                        <th>Fin du créneau</th>
                        <th>Nombre de places au total</th>
                        <th>Nombre de places disponibles</th>
                        <th>Date</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($creneau as $creneaux) {
                        $dateDebut = $creneaux['date'];
                        $newDateDebut = date("d-m-Y", strtotime($dateDebut));
                    ?>

                        <tr class="ligne" value="<?= $creneaux['id'] ?>">
                            <td><?= $creneaux['debut'] ?></td>
                            <td><?= $creneaux['fin'] ?></td>
                            <td><?= $creneaux['nbr_place'] ?></td>
                            <td><?= $creneaux['nbr_place_restant'] ?></td>
                            <td><?= $creneaux['date'] ?></td>
                        </tr>


                    <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?php base_url() ?>/js/singleSession.js"></script>
<?= $this->endSection() ?>