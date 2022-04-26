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
            "infos_reserv" => $this->reservation->call_reservation_infos(),
            "infos_pro" => $this->professionnels->call_pro_infos(),
            "myCreneaux" => $this->creneau->call_creneau_by_pro(4),
        ];

        return view('professionnels/index', $data);
    }
    public function prosIndex()
    {
        return view('professionnels/prosIndex');
    }
    private function generateNewsDataFromPost()
    {
        return [
            "titre" => $this->request->getPost('titre'),
            "date" => $this->request->getPost('date'),
            "debut" => $this->request->getPost('debut'),
            "fin" => $this->request->getPost('fin'),
            "nbr_place" => $this->request->getPost('title'),
            "debut_session" => $this->request->getPost('debut_session'),
            "fin_session" => $this->request->getPost('fin_session'),
            "creche_id" => $this->request->getPost('creche_id'),

        ];
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
                        "prenomPros" => $professionnels["prenomPros"],
                        "id" => $professionnels["id"]
                    ]);
                    return redirect()->to('prosIndex');
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
            'mail' => 'required|valid_email|is_unique[professionnels.mail]',
            'dateNaissancePros' => 'required',
            'mdp' => 'required|min_length[6]|max_length[255]',
            'adresse' => 'required',
            'tel' => 'required',
            'siret' => 'required',

        ])) {
            $professionnels = [
                "nomPros" => $this->request->getPost("nomPros"),
                "prenomPros" => $this->request->getPost("prenomPros"),
                "mail" => $this->request->getPost("mail"),
                "dateNaissancePros" => $this->request->getPost("dateNaissancePros"),
                "mdp" => password_hash($this->request->getPost("mdp"), PASSWORD_DEFAULT),
                "adresse" => $this->request->getPost("adresse"),
                "tel" => $this->request->getPost("tel"),
                "siret" => $this->request->getPost("siret"),


            ];

            $this->professionnels->insert($professionnels);
            return redirect()->to('prosIndex');
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

    function create()
    {
        if ($this->request->getMethod() === 'post') {


            if (!empty($this->request->getPost('debut')) && !empty($this->request->getPost('fin')) && !empty($this->request->getPost('titre'))) {
                $professionnels = $this->generateNewsDataFromPost();
                $this->ProfessionnelsModel->insert($professionnels);
            }
            return redirect()->to('/');
        } else {
            echo view("professionnels/create");
        }
    }
    function profil()
    {
        return view('professionnels/profil');
    }
}
