<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ReservationSplit;

class Utilisateurs extends BaseController
{
    private $creneau;
    private $enfants;
    private $parents;
    private $professionnels;
    private $reservation;
    private $session;
    private $messages;
    private $reservationSplit;
    private $recupere;

    function __construct()
    {
        $this->creneau = model(CreneauModel::class);
        $this->enfants = model(EnfantsModel::class);
        $this->parents = model(ParentsModel::class);
        $this->professionnels = model(ProfessionnelsModel::class);
        $this->reservation = model(ReservationModel::class);
        $this->session = model(SessionModel::class);
        $this->messages = model(MessagesModel::class);
        $this->reservationSplit = model(ReservationSplitModel::class);
        $this->recupere = model(RecupereModel::class);
    }

    public function index()
    {
        session()->destroy();
        return view('pages/accueil');
    }


    public function utilisateursIndex()
    {
        if ($this->request->isAJAX()) {
            $message = [
                'id_auteur' => $this->request->getPost('id_auteur'),
                'id_destinataire' => $this->request->getPost('id_destinataire'),
                "contenu" => $this->request->getPost('contenu'),
                "statut" => $this->request->getPost('statut')
            ];
            $this->messages->insert($message);
        }
        if ($this->request->getMethod() === 'post' && $this->validate([
            'latitudeHidden' => 'required',
            'longitudeHidden' => 'required',
        ])) {

            $position = [
                "latitudeParents" => $this->request->getPost("latitudeHidden"),
                "longitudeParents" => $this->request->getPost("longitudeHidden"),
            ];
            $this->parents->update(['id' => session('id')], $position);
            return redirect()->to('utilisateursIndex');
        } else {
            $data = [
                "localisation" => $this->professionnels->call_pro_by_localisation(),
                "position" => $this->parents->find(session("id")),
                "proByName" => $this->professionnels->call_pro_by_name('laguarderie'),
                "proInfosById" => $this->professionnels->call_pro_infos_by_id(1),
                "sessions" => $this->session->call_all_session(),
                'contact' => $this->messages->displayContactUser(),
                'allmessages' => $this->messages->displayAllMessages()
            ];

            return view('utilisateurs/utilisateursIndex', $data);
        }
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
                        "utilisateurs" => true,
                        "id" => $parents["id"]
                    ]);
                    return redirect()->to(base_url() . '/utilisateursIndex');
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



    public function messages($id)
    {
        if ($this->request->getMethod() === 'post' && $this->validate([
            'message' => 'required'

        ])) {


            $message = [
                'id_auteur' => session('id'),
                'id_destinataire' => $id,
                "contenu" => $this->request->getPost("message"),
                "statut" => "parent",

            ];

            $this->messages->insert($message);
            return redirect()->to(base_url() . '/messages/' . $id);
        } else {
            $data = [
                'message' => $this->messages->displayMessages($id)
            ];

            echo view("utilisateurs/messages", $data);
        }
    }



    public function inscription()
    {
        if ($this->request->getMethod() === 'post' && $this->validate([
            'nomParents' => 'required|min_length[3]|max_length[255]',
            'prenomParents' => 'required|min_length[3]|max_length[255]',
            'mailParents' => 'required|valid_email|is_unique[parents.mailParents]',
            'dateNaissanceParents' => 'required',
            'mdpParents' => 'required|min_length[6]|max_length[255]',
            'address' => 'required',
            'telParents' => 'required',

        ])) {

            $data_arr = $this->geocode($this->request->getPost("address"));

            // if able to geocode the address
            if ($data_arr) {

                $latitude = $data_arr[0];
                $longitude = $data_arr[1];
                var_dump($data_arr);


                $parents = [
                    "nomParents" => $this->request->getPost("nomParents"),
                    "prenomParents" => $this->request->getPost("prenomParents"),
                    "mailParents" => $this->request->getPost("mailParents"),
                    "dateNaissanceParents" => $this->request->getPost("dateNaissanceParents"),
                    "mdpParents" => password_hash($this->request->getPost("mdpParents"), PASSWORD_DEFAULT),
                    "adresseParents" => $this->request->getPost("address"),
                    "telParents" => $this->request->getPost("telParents"),
                    "latitudeParents" => $latitude,
                    "longitudeParents" => $longitude
                ];

                $this->parents->insert($parents);
                return redirect()->to(base_url() . '/');
            }
        } else {
            echo view("utilisateurs/inscription", [
                'validation' => $this->validator
            ]);
        }
    }
    public function updateLocalisation($lat, $long)
    {

        $position = [
            "latitudeParents" => $lat,
            "longitudeParents" => $long
        ];

        $this->parents->update(['id' => session("id")], $position);
    }

    public function deconnexion()
    {
        session()->destroy();
        return redirect()->to(base_url() . '/');
    }

    public function showEnfants()
    {
        $recupArray = [];
        $recup = [];
        $i = 0;
        $myKidsArray =
            $this->enfants->getEnfantsBySessionId();

        foreach ($myKidsArray as $myKid) {
            $recup = $this->recupere->call_recup_by_enfants($myKid['id']);
            foreach ($recup as $rec) {
                array_push($recupArray, $rec);
            }
        }



        $data = [
            'infos' => $myKidsArray,
            'recup' => $recupArray
        ];

        echo view("utilisateurs/showEnfants", $data);
    }

    public function showReservations()
    {
        $data = [
            "reservation" => $this->reservationSplit->test()

        ];
        echo view("utilisateurs/showReservations", $data);
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
            $nbr = $this->parents->find(session('id'));
            $parents = [
                "nbr_enfants" => $nbr["nbr_enfants"] + 1
            ];
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
            $this->parents->update(['id' => session('id')], $parents);
            return redirect()->to(base_url() . '/showEnfants');
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
            return redirect()->to(base_url() . '/showEnfants');
        } else {
            $data = [
                "data" => $this->enfants->find($id)
            ];
            echo view("utilisateurs/updateEnfants", $data);
        }
    }
    public function deleteEnfants($id)
    {
        $nbr = $this->parents->find(session('id'));
        $parents = [
            "nbr_enfants" => $nbr["nbr_enfants"] - 1
        ];
        $this->parents->update(['id' => session('id')], $parents);
        $this->enfants->delete($id);
        return redirect()->to(base_url() . '/showEnfants');
    }


    public function geocode($address)
    {


        // url encode the address
        $address = urlencode($address);

        // google map geocode api url
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=AIzaSyCHIY60MQ8Vyb5e7bM4P4_i5HsIcTr-kHw";

        // get the json response
        $resp_json = file_get_contents($url);

        // decode the json
        $resp = json_decode($resp_json, true);

        // response status will be 'OK', if able to geocode given address
        if ($resp['status'] == 'OK') {

            // get the important data
            $lati = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
            $longi = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
            $formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";

            // verify if data is complete
            if ($lati && $longi && $formatted_address) {

                // put the data in the array
                $data_arr = array();

                array_push(
                    $data_arr,
                    $lati,
                    $longi,
                    $formatted_address
                );

                return $data_arr;
            } else {
                return false;
            }
        } else {
            echo "<strong>ERROR: {$resp['status']}</strong>";
            return false;
        }
    }


    public function modifprofil()
    {
        if ($this->request->getMethod() === 'post' && $this->validate([
            'nomParents' => 'required',
            'prenomParents' => 'required',
            'dateNaissanceParents' => 'required',
            'adresseParents' => 'required',
            'nbr_enfants' => 'required',
            'mailParents' => 'required',
            'telParents' => 'required',
            'mdpParents' => 'required'
        ])) {
            $parents = [
                "nomParents" => $this->request->getPost("nomParents"),
                "prenomParents" => $this->request->getPost("prenomParents"),
                "adresseParents" => $this->request->getPost("adresseParents"),
                "dateNaissanceParents" => $this->request->getPost("dateNaissanceParents"),
                "nbr_enfants" => $this->request->getPost("nbr_enfants"),
                "mailParents" => $this->request->getPost("mailParents"),
                "telParents" => $this->request->getPost("telParents"),
                "mdpParents" => $this->request->getPost("mdpParents")
            ];
            $this->parents->update(['id' => session('id')], $parents);
            return redirect()->to(base_url() . '/profil');
        } else {
            $data = [
                "data" => $this->parents->find(session('id'))
            ];
            echo view("utilisateurs/profil", $data);
        }
    }

    public function singleUser($id)
    {

        $data = [
            "data" => $this->professionnels->find($id)
        ];

        echo view("utilisateurs/singleUser", $data);
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function singleSession($id)
    {
        if ($this->request->getMethod() === 'post' && $this->validate([
            'list' => 'required',
            'date_debut' => 'required',
            'date_fin' => 'required',
            'debut_session' => 'required',
            'fin_session' => 'required'
        ])) {

            $randomName = $this->generateRandomString();

            $allCreneau = $this->creneau->call_creneau_infos_by_idSession($id);
            $debutDate = $this->request->getPost("date_debut");
            $finDate = $this->request->getPost("date_fin");

            $debutSession = $this->request->getPost("debut_session");
            $finSession = $this->request->getPost("fin_session");

            $debut = strtotime($this->request->getPost("date_debut"));
            $fin = strtotime($this->request->getPost("date_fin"));
            $dif = ceil(abs($fin - $debut) / 86400);

            
            if ($dif == 0) {
                for ($i = $debutSession; $i < $finSession; $i++) {
                    $boucleDebut = $i;
                    $boucleFin = $i + 1;
                    foreach ($allCreneau as $allCreneaux) {
                        if ($allCreneaux['debut'] == $boucleDebut && $allCreneaux['fin'] == $boucleFin && $allCreneaux['date'] == $debutDate) {
                            echo ('oui');
                            $data = [
                                "nbr_place_restant" => $allCreneaux['nbr_place_restant'] - 1
                            ];
                            $this->creneau->update(["id" => $allCreneaux['id']], $data);

                            $data = [
                                "id_enfant" => $this->request->getPost('list'),
                                "id_creneau" => $allCreneaux['id'],
                                "id_reservation" => $randomName
                            ];
                            $this->reservation->insert($data);
                        }
                    }
                }
            } elseif ($dif > 0) {
                for ($i = $debutSession; $i < 24; $i++) {
                    $boucleDebut = $i;
                    $boucleFin = $i + 1;
                    foreach ($allCreneau as $allCreneaux) {
                        if ($allCreneaux['debut'] == $boucleDebut && $allCreneaux['fin'] == $boucleFin && $allCreneaux['date'] == $debutDate) {
                            echo ('oui');
                            $data = [
                                "nbr_place_restant" => $allCreneaux['nbr_place_restant'] - 1
                            ];
                            $this->creneau->update(["id" => $allCreneaux['id']], $data);

                            $data = [
                                "id_enfant" => $this->request->getPost('list'),
                                "id_creneau" => $allCreneaux['id'],
                                "id_reservation" => $randomName
                            ];
                            $this->reservation->insert($data);
                        }
                    }
                }
                for ($i = 0; $i < ($dif - 1); $i++) {
                    $nombrejour = $i + 1;
                    $date = date('Y-m-d', strtotime($this->request->getPost("date_debut") . " +" . $nombrejour . " days"));
                    for ($j = 0; $j < 24; $j++) {
                        $boucleDebut = $j;
                        $boucleFin = $j + 1;
                        foreach ($allCreneau as $allCreneaux) {
                            if ($allCreneaux['debut'] == $boucleDebut && $allCreneaux['fin'] == $boucleFin && $allCreneaux['date'] == $date) {
                                echo ('test');
                                $data = [
                                    "nbr_place_restant" => $allCreneaux['nbr_place_restant'] - 1
                                ];
                                $this->creneau->update(["id" => $allCreneaux['id']], $data);

                                $data = [
                                    "id_enfant" => $this->request->getPost('list'),
                                    "id_creneau" => $allCreneaux['id'],
                                    "id_reservation" => $randomName
                                ];
                                $this->reservation->insert($data);
                            }
                        }
                    }
                }
                for ($i = 0; $i < $finSession; $i++) {
                    $boucleDebut = $i;
                    $boucleFin = $i + 1;
                    foreach ($allCreneau as $allCreneaux) {
                        if ($allCreneaux['debut'] == $boucleDebut && $allCreneaux['fin'] == $boucleFin && $allCreneaux['date'] == $finDate) {
                            echo ('oui');
                            $data = [
                                "nbr_place_restant" => $allCreneaux['nbr_place_restant'] - 1
                            ];
                            $this->creneau->update(["id" => $allCreneaux['id']], $data);

                            $data = [
                                "id_enfant" => $this->request->getPost('list'),
                                "id_creneau" => $allCreneaux['id'],
                                "id_reservation" => $randomName
                            ];
                            $this->reservation->insert($data);
                        }
                    }
                }
            }
            $data = [
                "nom_reservation"=>$randomName,
                "debut_reservation"=> $debutSession,
                "fin_reservation"=>$finSession,
                "debut_date_reservation"=> $debutDate,
                "fin_date_reservation"=>$finDate
            ];
            $this->reservationSplit->insert($data);

            return redirect()->to(base_url() . '/showReservations');
        } else {
            $data = [
                "enfants" => $this->enfants->getEnfantsBySessionId(),
                "creneau" => $this->creneau->call_creneau_infos_by_idSession($id)
            ];
            echo view("utilisateurs/singleSession", $data);
        }
    }
}
