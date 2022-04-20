<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Utilisateurs extends BaseController
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
        return view('utilisateurs/index');
    }
    public function connection()
    {
        return view('utilisateurs/connection');
    }
    public function inscription()
    {
        return view('utilisateurs/inscription');
    }
}
