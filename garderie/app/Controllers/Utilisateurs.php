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
        $data = [
            "data" => $this->enfants->getEnfantsBySessionId()
        ];
        return view('utilisateurs/index',$data);
    }
    public function utilisateursIndex()
    {
        return view('utilisateurs/utilisateursIndex');
    }
    public function connexion()
    {
        if ($this->request->getMethod() === 'post' && $this->validate([
            'mail' => 'required|valid_email',
            'mdp' => 'required',
        ])) {

            $emailPost = $this->request->getPost("mail");
            $passwordPost = $this->request->getPost("mdp");

            $parents = $this->parents->findByEmail($emailPost);
            if (!empty($parents)) {
                if (password_verify($passwordPost, $parents["mdp"])) {
                    session()->set([
                        "mail" => $parents["mail"],
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
            'mail' => 'required|valid_email|is_unique[parents.mail]',
            'dateNaissanceParents' => 'required',
            'mdp' => 'required|min_length[6]|max_length[255]',
            'adresse' => 'required',
            'tel' => 'required',

        ])) {
            $parents = [
                "nomParents" => $this->request->getPost("nomParents"),
                "prenomParents" => $this->request->getPost("prenomParents"),
                "mail" => $this->request->getPost("mail"),
                "dateNaissanceParents" => $this->request->getPost("dateNaissanceParents"),
                "mdp" => password_hash($this->request->getPost("mdp"), PASSWORD_DEFAULT),
                "adresse" => $this->request->getPost("adresse"),
                "tel" => $this->request->getPost("tel"),

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
}
