<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CreneauModel;
use App\Models\EnfantsModel;
use App\Models\ParentsModel;
use App\Models\ProfessionnelsModel;
use App\Models\ReservationModel;

class Professionnels extends BaseController
{
    private $creneau;
    private $enfants;
    private $parents;
    private $professionnels;
    private $reservation;

    function __construct()
    {
        $this->creneau = model(CreneauModel::class);
        $this->enfants = model(EnfantsModel::class);
        $this->parents = model(ParentsModel::class);
        $this->professionnels = model(ProfessionnelsModel::class);
        $this->reservation = model(ReservationModel::class);
    }
    
    public function index()
    {
        return view('professionnels/index');
    }
}
