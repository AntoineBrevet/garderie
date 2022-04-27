<<<<<<< Updated upstream
<?= $this->extend('master') ?>
=======
<?= $this->extend('master') ?>

<?= $this->section('css') ?>
<!-- Mettre le CSS avec une balise link -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Mettre le content de la page -->
<div id="map" style="width: 500px; height: 400px;"></div>
<button onclick="getLocation()">Trouver les pros les plus proches</button>


<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- Mettre le JS avec une balise script -->
<script>

    var iCount = 1;
    var locations = [];

</script>
<?php foreach ($localisation as $localisations){
   ?>
    <script>

        var longitude = "<?= $localisations["longitudePros"] ?>";
        var latitude = "<?= $localisations["latitudePros"] ?>";
        var nomPros = "<?= $localisations["nomPros"] ?>";

        locations.push([nomPros, latitude, longitude, iCount]);
        iCount++;
    </script>

<?php
}

?>
    <script>

        var longitudeParent = "<?= $position["longitudeParents"] ?>";
        var latitudeParent = "<?= $position["latitudeParents"] ?>";

    </script>

<script type="text/javascript">




</script>
<script src="http://maps.google.com/maps/api/js?key=AIzaSyCHIY60MQ8Vyb5e7bM4P4_i5HsIcTr-kHw"
        type="text/javascript"></script>
<script src="<?php base_url() ?>/js/map.js"></script>
<script src="<?php base_url() ?>/js/getLocation.js"></script>
<script type="text/javascript"> var urlAjax =  "<?= base_url() ?>"</script>


<?= $this->endSection() ?>

>>>>>>> Stashed changes
