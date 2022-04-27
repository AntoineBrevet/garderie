<?php

use App\Controllers\Utilisateurs;

$latitude = $_POST['latitude'];
$longitude = $_POST["longitude"];

$position = new Utilisateurs();
$position->updateLocalisation($latitude, $longitude);
