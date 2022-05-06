<?= $this->extend('master') ?>

<?= $this->section('css') ?>
<link href="<?= base_url(); ?>/css/singleSession.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Mettre le content de la page -->
<section class="containerSession">
    <div class="container">
        <h1>Réservez une place pour votre enfant</h1>
        <h3 style="color: white;">Prix par heure : <?= $creneau[0]['prix'] ?>€</h3>
        <form method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="<?= STRIPE_KEY ?>" id="payment-form">
            <input type="text" name="prix" value="<?= $creneau[0]['prix'] ?>" hidden>

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

            <button type="button" class="btn btn-primary btn-lg btn-block" id="myBtn">Réserver ce créneau</button>

            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="panel panel-default credit-card-box">
                                <div class="panel-body">


                                    <div class='form-row row'>
                                        <div class='col-xs-12 form-group required'>
                                            <label class='control-label'>Name on Card</label>
                                            <input class='form-control' size='4' type='text'>
                                        </div>
                                    </div>

                                    <div class='form-row row'>
                                        <div class='col-xs-12 form-group card required'>
                                            <label class='control-label'>Card Number</label>
                                            <input autocomplete='off' class='form-control card-number' size='20' type='text'>
                                        </div>
                                    </div>

                                    <div class='form-row row'>
                                        <div class='col-xs-12 col-md-4 form-group cvc required'>
                                            <label class='control-label'>CVC</label>
                                            <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                                        </div>
                                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                                            <label class='control-label'>Expiration Month</label>
                                            <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                                        </div>
                                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                                            <label class='control-label'>Expiration Year</label>
                                            <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                                        </div>
                                    </div>

                                    <div class='form-row row'>
                                        <div class='col-md-12 error form-group hide'>
                                            <div class='alert-danger alert'>Please correct the errors and try
                                                again.</div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12">
                                            <button class="btn btn-primary btn-lg btn-block" type="submit" name="action">Payer maintenant</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<?= $this->endSection() ?>