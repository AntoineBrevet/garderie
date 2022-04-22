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
        $data = [
            "infos" => $this->reservation->call_reservation_infos()
        ];

        return view('professionnels/index', $data);
    }

    public function splitByHour($data)
    // prends le tableau entier et le slit par heure
    {
        $debut = $data['debut_session'];
        $fin = $data['fin_session'];
        for ($i = $debut; $i < $fin; $i++) {
            $data['debut'] = $i;
            $data['fin'] = $i + 1;
            $this->db->table('creneau')->insert($data);
        }
    }
    public function connexionPros()
    {
        if ($this->request->getMethod() === 'post' && $this->validate([
            'mail' => 'required|valid_email',
            'mdp' => 'required',
        ])) {

            $emailPost = $this->request->getPost("mail");
            $passwordPost = $this->request->getPost("mdp");

            $professionnels = $this->professionnels->findByEmail($emailPost);
            if (!empty($professionnels)) {
                if (password_verify($passwordPost, $professionnels["mdp"])) {
                    session()->set([
                        "mail" => $professionnels["mail"],
                        "prenomParents" => $professionnels["prenomParents"],
                        "id" => $professionnels["id"]
                    ]);
                    return redirect()->to('/');
                } else {
                    echo 'Le mot de passe est invalide.';
                }
            } else {
                echo ("Cet email n'existe pas");
            }
        }
        echo view("professionnels/connexionPros", [
            'validation' => $this->validator
        ]);
    }
    public function inscriptionPros()
    {
        if ($this->request->getMethod() === 'post' && $this->validate([
            'nomPros' => 'required|min_length[3]|max_length[255]',
            'prenomPros' => 'required|min_length[3]|max_length[255]',
            'mail' => 'required|valid_email|is_unique[parents.mail]',
            'dateNaissancePros' => 'required',
            'mdp' => 'required|min_length[6]|max_length[255]',
            'adresse' => 'required',
            'tel' => 'required',

        ])) {
            $professionnels = [
                "nomPros" => $this->request->getPost("nomParents"),
                "prenomPros" => $this->request->getPost("prenomParents"),
                "mail" => $this->request->getPost("mail"),
                "dateNaissancePros" => $this->request->getPost("dateNaissanceParents"),
                "mdp" => password_hash($this->request->getPost("mdp"), PASSWORD_DEFAULT),
                "adresse" => $this->request->getPost("adresse"),
                "tel" => $this->request->getPost("tel"),

            ];

            $this->professionnels->insert($professionnels);
            return redirect()->to('/');
        } else {
            echo view("professionnels/inscriptionPros", [
                'validation' => $this->validator
            ]);
        }
    }
    public function deconnexionPros()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
