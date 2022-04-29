<?= $this->extend('master') ?>

<?= $this->section('css') ?>
<link href="<?= base_url(); ?>/css/indexUser.css" rel="stylesheet">

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Mettre le content de la page -->
<div id="map" style="width: 500px; height: 400px;"></div>

<form class="myForm" method="post" autocomplete="off">

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


<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="http://maps.google.com/maps/api/js?key=AIzaSyCHIY60MQ8Vyb5e7bM4P4_i5HsIcTr-kHw" type="text/javascript"></script>
<script src="<?php base_url() ?>/js/map.js"></script>
<script src="<?php base_url() ?>/js/getLocation.js"></script>
<script src="<?php base_url() ?>/js/apiSiret.js"></script>



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

<?php

// foreach($ as $){
//     echo ' ' . $i .' : Infos<br>';
//     echo $info_reserv['nomEnfants'] . ' ' . $info_reserv['prenomEnfants'] .'<br>';
//     echo $info_reserv['nomParents'] . ' ' . $info_reserv['prenomParents']. '-' . $info_reserv['telParents'] .'<br>';
//     echo $info_reserv['nomRecup'] . ' ' . $info_reserv['prenomRecup']. '-' . $info_reserv['telRecup'].'<br>';
//     echo '<hr>';

// };
?>

<script type="text/javascript">
    var urlAjax = "<?= base_url() ?>"
</script>

<?= $this->endSection() ?>