<?= $this->extend('master') ?>

<?= $this->section('css') ?>
<link href="<?= base_url(); ?>/css/indexUser.css" rel="stylesheet">
<link href="<?= base_url(); ?>/css/messagesPv.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php

include 'messagesPvPros.php';
?>

<!-- Mettre le content de la page -->
<section class="sec1">
    <h1>Cherechez des creches autours de vous</h1>

    <div class="myForm">
        <form method="post" autocomplete="off">


            <input type="hidden" id="latitudeHidden" name="latitudeHidden">
            <input type="hidden" id="longitudeHidden" name="longitudeHidden">

            <label for="pet-select">Distance :</label>

            <select onchange=change() name="selectVal" id="selectVal">
                <option value="1">1km</option>
                <option value="2">2km</option>
                <option value="5">5km</option>
                <option value="10">10km</option>
                <option value="20">20km</option>
                <option value="50">50km</option>
                <option value="100">100km</option>
                <option value="France" selected>Toute la france</option>
            </select><br>

            <input type="submit" id="submitLocalisation" name="submit" value="Actualiser la carte">
        </form>
        <button id="buttonHidden" onclick="getLocation()">Trouver les pros les plus proches</button>



    </div>
    <div id="map" style="width: 90%; height: 600px;"></div>
</section>


<section class="sec2">
    <div>
        <h1>Feeds Annonces</h1>

    </div>

</section>
<div class="dates">
    <div>
        <label>Debut : </label>
        <input type="date" name="dateDebut" id="dateDebut" style="color:black">
    </div>
    <br>
    <div>
        <label>Fin : </label>

        <input type="date" name="dateFin" id="dateFin" style="color:black">
    </div>
</div>
<div class="feed">

    <?php
    foreach ($sessions as $session) {
        var_dump($session);
        $dateDebut = $session["date_debut"];
        $newDateDebut = date("d-m-Y", strtotime($dateDebut));
        $dateFin = $session["date_fin"];
        $newDateFin = date("d-m-Y", strtotime($dateFin));
    ?>
        <div class="annonces">
            <div class="id">
                <?php echo $session['creche_id'] ?>
            </div>
            <br>
            <div class="column">
                <div class="nom">
                    <img src="<?= base_url() ?>/img/profile.png" alt=""><?php echo $session['nomPros'] ?>
                </div>

                <div class="mail">
                    <img src="<?= base_url() ?>/img/email.png" alt=""><?php echo $session['mailPros'] ?>
                </div>
            </div>
            <hr>
            <div class="column">
                <div class="tel">
                    <img src="<?= base_url() ?>/img/telephone.png" alt=""> <?php echo $session['telPros'] ?>
                </div>

                <div class="adresse">
                    <img src="<?= base_url() ?>/img/adresse.png" alt=""> <?php echo $session['adressePros'] ?>
                </div>
            </div>
            <hr>
            <div class="heures">
                <img src="<?= base_url() ?>/img/heure.png" alt=""> <?php echo $newDateDebut . " - " . $session['debutSession'] . " heures " . " " ?><?php echo $newDateFin . " - " . $session['finSession'] . " heures " ?>
            </div>
            <br>
            <div>
                <a href="<?= base_url(); ?>/singleUser/<?= $session["creche_id"]; ?>" class="profil_candidat">voir le profil</a>
            </div>
            <br>
            <div>
                <a href="<?= base_url(); ?>/singleSession/<?= $session["id"]; ?>" class="profil_candidat">Réserver sur ce créneau</a>
            </div>
        </div>
        <br>
    <?php } ?>


</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="http://maps.google.com/maps/api/js?key=AIzaSyCHIY60MQ8Vyb5e7bM4P4_i5HsIcTr-kHw" type="text/javascript"></script>
<script src="<?php base_url() ?>/js/map.js"></script>
<script src="<?php base_url() ?>/js/getLocation.js"></script>
<script src="<?php base_url() ?>/js/apiSiret.js"></script>
<script src="<?php base_url() ?>/js/dateRechercheUser.js"></script>




<script>
    function change() {

        const select = document.querySelector('#selectVal').value

        var iCount = 1;
        var locations = [];


        <?php foreach ($localisation as $localisations) {
        ?>

            function distance(lat1,
                lat2, lon1, lon2) {

                // The math module contains a function
                // named toRadians which converts from
                // degrees to radians.
                lon1 = lon1 * Math.PI / 180;
                lon2 = lon2 * Math.PI / 180;
                lat1 = lat1 * Math.PI / 180;
                lat2 = lat2 * Math.PI / 180;

                // Haversine formula
                let dlon = lon2 - lon1;
                let dlat = lat2 - lat1;
                let a = Math.pow(Math.sin(dlat / 2), 2) +
                    Math.cos(lat1) * Math.cos(lat2) *
                    Math.pow(Math.sin(dlon / 2), 2);

                let c = 2 * Math.asin(Math.sqrt(a));

                // Radius of earth in kilometers. Use 3956
                // for miles
                let r = 6371;

                // calculate the result
                return (c * r);
            }

            var longitudeParent = "<?= $position["longitudeParents"] ?>";
            var latitudeParent = "<?= $position["latitudeParents"] ?>";
            var longitudePros = "<?= $localisations["longitudePros"] ?>";
            var latitudePros = "<?= $localisations["latitudePros"] ?>";
            var nomPros = "<?= $localisations["nomPros"] ?>";


            if (distance(latitudePros, latitudeParent,
                    longitudePros, longitudeParent) < select) {

                locations.push([nomPros, latitudePros, longitudePros, iCount]);
                iCount++;

            } else if (select === "France") {
                locations.push([nomPros, latitudePros, longitudePros, iCount]);
            }



            var map = new google.maps.Map(document.getElementById('map'), {

                zoom: 9,
                center: new google.maps.LatLng(latitudeParent, longitudeParent),
                mapTypeId: google.maps.MapTypeId.ROADMAP

            });

            var infowindow = new google.maps.InfoWindow();

            var marker, i;

            for (i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map
                });


                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        infowindow.setContent(locations[i][0]);
                        infowindow.open(map, marker);

                    }
                })(marker, i));
            }
        <?php
        }
        ?>


    }

    var iCount = 1;
    var locations = [];


    <?php foreach ($localisation as $localisations) {
    ?>



        var longitudeParent = "<?= $position["longitudeParents"] ?>";
        var latitudeParent = "<?= $position["latitudeParents"] ?>";
        var longitudePros = "<?= $localisations["longitudePros"] ?>";
        var latitudePros = "<?= $localisations["latitudePros"] ?>";
        var nomPros = "<?= $localisations["nomPros"] ?>";


        locations.push([nomPros, latitudePros, longitudePros, iCount]);
        iCount++;

        var map = new google.maps.Map(document.getElementById('map'), {

            zoom: 6,
            center: new google.maps.LatLng(latitudeParent, longitudeParent),
            mapTypeId: google.maps.MapTypeId.ROADMAP

        });

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map
            });


            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);

                }
            })(marker, i));
        }
    <?php
    }
    ?>
</script>


<script type="text/javascript">
    var urlAjax = "<?= base_url() ?>"
    var urlAjaxSearchStart = "<?= base_url('utilisateursIndex'); ?>"
    var urlAjaxSearchEnd = "<?= base_url('utilisateursIndex'); ?>"
    var urlAjaxSearchBoth = "<?= base_url('utilisateursIndex'); ?>"

    document.querySelector('#dateDebut').addEventListener('input', searchStart)
    document.querySelector('#dateFin').addEventListener('input', searchEnd)

    function searchStart() {
        if (document.querySelector('#dateFin').value === "") {

            document.querySelector('.feed').innerHTML = '';

            <?php
            for ($i = 0; $i < count($sessions); $i++) {
                $dateDebut = $sessions[$i]["date_debut"];
                $newDateDebut = date("d-m-Y", strtotime($dateDebut));
                $dateFin = $sessions[$i]["date_fin"];
                $newDateFin = date("d-m-Y", strtotime($dateFin));
            ?>

                var dateDebut = "<?= $newDateDebut ?>";
                var dateFin = "<?= $newDateFin ?>";
                var dateDebut2 = "<?= $dateDebut ?>";
                var dateFin2 = "<?= $dateFin ?>";
                var heureDebut = "<?= $sessions[$i]["debutSession"] ?>";
                var heureFin = "<?= $sessions[$i]["finSession"] ?>";
                var idCreche = "<?= $sessions[$i]["creche_id"] ?>";
                var nomPros = "<?= $sessions[$i]["nomPros"] ?>";
                var mailPros = "<?= $sessions[$i]["mailPros"] ?>";
                var telPros = "<?= $sessions[$i]["telPros"] ?>";
                var adressePros = "<?= $sessions[$i]["adressePros"] ?>";

                if (document.querySelector('#dateDebut').value >= dateDebut2 && document.querySelector('#dateDebut').value <= dateFin2) {
                    document.querySelector('.feed').innerHTML += '<div class="annonces"><div class="id">' + idCreche + '</div><br><div class="column"><div class="nom"><img src="<?= base_url() ?>/img/profile.png" alt="">' + nomPros + '</div><div class="mail"><img src="<?= base_url() ?>/img/email.png" alt="">' + mailPros + '</div></div><hr><div class="column"><div class="tel"><img src="<?= base_url() ?>/img/telephone.png" alt="">' + telPros + '</div><div class="adresse"><img src="<?= base_url() ?>/img/adresse.png" alt="">' + adressePros + '</div></div><hr><div class="heures"><img src="<?= base_url() ?>/img/heure.png" alt="">' + dateDebut + ' - ' + heureDebut + ' heures ' + dateFin + ' - ' + heureFin + ' heures</div><br><div><a href="<?= base_url(); ?>/singleUser/' + idCreche + '" class="profil_candidat">voir le profil</a></div></div><br>'
                }
                <?php
                if ($i == count($sessions) - 1) {
                ?>
                    if (document.querySelector('.feed').innerHTML == '') {
                        console.log("oui");
                        document.querySelector('.feed').innerHTML += 'Aucun créneau trouvé!'
                    }
            <?php
                }
            }
            ?>
        } else {
            searchBoth();
        }
    }

    function searchEnd() {
        if (document.querySelector('#dateDebut').value === "") {

            document.querySelector('.feed').innerHTML = '';

            <?php
            for ($i = 0; $i < count($sessions); $i++) {
                $dateDebut = $sessions[$i]["date_debut"];
                $newDateDebut = date("d-m-Y", strtotime($dateDebut));
                $dateFin = $sessions[$i]["date_fin"];
                $newDateFin = date("d-m-Y", strtotime($dateFin));
            ?>

                var dateDebut = "<?= $newDateDebut ?>";
                var dateFin = "<?= $newDateFin ?>";
                var dateDebut2 = "<?= $dateDebut ?>";
                var dateFin2 = "<?= $dateFin ?>";
                var heureDebut = "<?= $sessions[$i]["debutSession"] ?>";
                var heureFin = "<?= $sessions[$i]["finSession"] ?>";
                var idCreche = "<?= $sessions[$i]["creche_id"] ?>";
                var nomPros = "<?= $sessions[$i]["nomPros"] ?>";
                var mailPros = "<?= $sessions[$i]["mailPros"] ?>";
                var telPros = "<?= $sessions[$i]["telPros"] ?>";
                var adressePros = "<?= $sessions[$i]["adressePros"] ?>";

                if (document.querySelector('#dateFin').value >= dateDebut2 && document.querySelector('#dateFin').value <= dateFin2) {
                    document.querySelector('.feed').innerHTML += '<div class="annonces"><div class="id">' + idCreche + '</div><br><div class="column"><div class="nom"><img src="<?= base_url() ?>/img/profile.png" alt="">' + nomPros + '</div><div class="mail"><img src="<?= base_url() ?>/img/email.png" alt="">' + mailPros + '</div></div><hr><div class="column"><div class="tel"><img src="<?= base_url() ?>/img/telephone.png" alt="">' + telPros + '</div><div class="adresse"><img src="<?= base_url() ?>/img/adresse.png" alt="">' + adressePros + '</div></div><hr><div class="heures"><img src="<?= base_url() ?>/img/heure.png" alt="">' + dateDebut + ' ' + heureDebut + ' ' + dateFin + ' ' + heureFin + '</div><br><div><a href="<?= base_url(); ?>/singleUser/' + idCreche + '" class="profil_candidat">voir le profil</a></div></div><br>'
                }
                <?php
                if ($i == count($sessions) - 1) {
                ?>
                    if (document.querySelector('.feed').innerHTML == '') {
                        document.querySelector('.feed').innerHTML += 'Aucun créneau trouvé!'
                    }
            <?php
                }
            }
            ?>
        } else {
            searchBoth();
        }
    }


    function searchBoth() {
        document.querySelector('.feed').innerHTML = '';

        <?php
        for ($i = 0; $i < count($sessions); $i++) {
            $dateDebut = $sessions[$i]["date_debut"];
            $newDateDebut = date("d-m-Y", strtotime($dateDebut));
            $dateFin = $sessions[$i]["date_fin"];
            $newDateFin = date("d-m-Y", strtotime($dateFin));
        ?>

            var dateDebut = "<?= $newDateDebut ?>";
            var dateFin = "<?= $newDateFin ?>";
            var dateDebut2 = "<?= $dateDebut ?>";
            var dateFin2 = "<?= $dateFin ?>";
            var heureDebut = "<?= $sessions[$i]["debutSession"] ?>";
            var heureFin = "<?= $sessions[$i]["finSession"] ?>";
            var idCreche = "<?= $sessions[$i]["creche_id"] ?>";
            var nomPros = "<?= $sessions[$i]["nomPros"] ?>";
            var mailPros = "<?= $sessions[$i]["mailPros"] ?>";
            var telPros = "<?= $sessions[$i]["telPros"] ?>";
            var adressePros = "<?= $sessions[$i]["adressePros"] ?>";

            if (document.querySelector('#dateDebut').value >= dateDebut2 && document.querySelector('#dateFin').value <= dateFin2) {
                document.querySelector('.feed').innerHTML += '<div class="annonces"><div class="id">' + idCreche + '</div><br><div class="column"><div class="nom"><img src="<?= base_url() ?>/img/profile.png" alt="">' + nomPros + '</div><div class="mail"><img src="<?= base_url() ?>/img/email.png" alt="">' + mailPros + '</div></div><hr><div class="column"><div class="tel"><img src="<?= base_url() ?>/img/telephone.png" alt="">' + telPros + '</div><div class="adresse"><img src="<?= base_url() ?>/img/adresse.png" alt="">' + adressePros + '</div></div><hr><div class="heures"><img src="<?= base_url() ?>/img/heure.png" alt="">' + dateDebut + ' ' + heureDebut + ' ' + dateFin + ' ' + heureFin + '</div><br><div><a href="<?= base_url(); ?>/singleUser/' + idCreche + '" class="profil_candidat">voir le profil</a></div></div><br>'
            }
            <?php
            if ($i == count($sessions) - 1) {
            ?>
                if (document.querySelector('.feed').innerHTML == '') {
                    document.querySelector('.feed').innerHTML += 'Aucun créneau trouvé!'
                }
        <?php
            }
        }
        ?>


    }

    var urlAjaxMessage = "<?= base_url('utilisateursIndex'); ?>"
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<?= $this->endSection() ?>