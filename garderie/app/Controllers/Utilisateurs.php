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

    public function profil()
    {
        $this->parents->find(session("id"));
        $data = [
            "data" => $this->parents->find(session("id"))
            
        ];
        return view('utilisateurs/profil', $data);
    }

    public function utilisateursIndex()
    {
        return view('utilisateurs/utilisateursIndex');
    }
    public function connexion()
    {
        if ($this->request->getMethod() === 'post' && $this->validate([
            'mailParents' => 'required|valid_email',
            'mdpParents' => 'required',
        ])) {

            $emailPost = $this->request->getPost("mailParents");
            $passwordPost = $this->request->getPost("mdpParents");

            $parents = $this->parents->findByEmail($emailPost);
            if (!empty($parents)) {
                if (password_verify($passwordPost, $parents["mdpParents"])) {
                    session()->set([
                        "mailParents" => $parents["mailParents"],
                        "prenomParents" => $parents["prenomParents"],
                        "id" => $parents["id"]
                    ]);
                    return redirect()->to('utilisateurs/utilisateursIndex');
                } else {
                    echo 'Le mot de passe est invalide.';
                }
            } else {
                echo ("Cet email n'existe pas");
            }
        }
        echo view("utilisateurs/connexion", [
            'validation' => $this->validator
        ]);
    }
    public function inscription()
    {
        if ($this->request->getMethod() === 'post' && $this->validate([
            'nomParents' => 'required|min_length[3]|max_length[255]',
            'prenomParents' => 'required|min_length[3]|max_length[255]',
            'mailParents' => 'required|valid_email|is_unique[parents.mailParents]',
            'dateNaissanceParents' => 'required',
            'mdpParents' => 'required|min_length[6]|max_length[255]',
            'adresseParents' => 'required',
            'telParents' => 'required',

        ])) {
            $parents = [
                "nomParents" => $this->request->getPost("nomParents"),
                "prenomParents" => $this->request->getPost("prenomParents"),
                "mailParents" => $this->request->getPost("mailParents"),
                "dateNaissanceParents" => $this->request->getPost("dateNaissanceParents"),
                "mdpParents" => password_hash($this->request->getPost("mdpParents"), PASSWORD_DEFAULT),
                "adresseParents" => $this->request->getPost("adresseParents"),
                "telParents" => $this->request->getPost("telParents"),

            ];

            $this->parents->insert($parents);
            return redirect()->to('utilisateurs/utilisateursIndex');
        } else {
            echo view("utilisateurs/inscription", [
                'validation' => $this->validator
            ]);
        }
    }
    public function deconnexion()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    public function showEnfants()
    {
        $data = [
            "data" => $this->enfants->getEnfantsBySessionId()
        ];
        echo view("utilisateurs/showEnfants", $data);
    }
    public function createEnfants()
    {
        if ($this->request->getMethod() === 'post' && $this->validate([
            'nomEnfants' => 'required',
            'prenomEnfants' => 'required',
            'sexeEnfants' => 'required',
            'dateNaissanceEnfants' => 'required',
            'allergies' => 'required',
            'medicaments' => 'required'
        ])) {

            $enfants = [
                "nomEnfants" => $this->request->getPost("nomEnfants"),
                "prenomEnfants" => $this->request->getPost("prenomEnfants"),
                "sexeEnfants" => $this->request->getPost("sexeEnfants"),
                "dateNaissanceEnfants" => $this->request->getPost("dateNaissanceEnfants"),
                "allergies" => $this->request->getPost("allergies"),
                "medicaments" => $this->request->getPost("medicaments"),
                "parents_id" => session("id")
            ];
            $this->enfants->insert($enfants);
            return redirect()->to('showEnfants');
        } else {
            echo view("utilisateurs/createEnfants");
        }
    }
    public function updateEnfants($id)
    {
        if ($this->request->getMethod() === 'post' && $this->validate([
            'nomEnfants' => 'required',
            'prenomEnfants' => 'required',
            'sexeEnfants' => 'required',
            'dateNaissanceEnfants' => 'required',
            'allergies' => 'required',
            'medicaments' => 'required'
        ])) {
            $enfants = [
                "nomEnfants" => $this->request->getPost("nomEnfants"),
                "prenomEnfants" => $this->request->getPost("prenomEnfants"),
                "sexeEnfants" => $this->request->getPost("sexeEnfants"),
                "dateNaissanceEnfants" => $this->request->getPost("dateNaissanceEnfants"),
                "allergies" => $this->request->getPost("allergies"),
                "medicaments" => $this->request->getPost("medicaments")
            ];
            $this->enfants->update(['id' => $id], $enfants);
            return redirect()->to('showEnfants');
        } else {
            $data = [
                "data" => $this->enfants->find($id)
            ];
            echo view("utilisateurs/updateEnfants", $data);
        }
    }
    public function deleteEnfants($id)
    {
        $this->enfants->delete($id);
        return redirect()->to('showEnfants');
    }
}
