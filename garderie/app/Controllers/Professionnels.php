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
    private $recupere;
    private $session;
    private $messages;


    function __construct()
    {
        $this->creneau = model(CreneauModel::class);
        $this->enfants = model(EnfantsModel::class);
        $this->parents = model(ParentsModel::class);
        $this->professionnels = model(ProfessionnelsModel::class);
        $this->reservation = model(ReservationModel::class);
        $this->recupere = model(RecupereModel::class);
        $this->session = model(SessionModel::class);
        $this->messages = model(MessagesModel::class);
    }

    public function index()
    {
        session()->destroy();
        $data = [
            "infos_reserv" => $this->reservation->call_reservation_infos(),
            "infos_pro" => $this->professionnels->call_pro_infos_by_id(1),
            "myCreneaux" => $this->creneau->call_creneau_by_pro(4),
            "creneauPlaces" => $this->creneau->call_creneau_by_places(30),
            "allCreneau" =>  $this->creneau->call_all_creneau(),
            "creneauInfos" => $this->creneau->call_creneau_infos_by_id(3),
            "recupByEnfant" => $this->recupere->call_recup_by_enfants(1),
        ];

        return view('professionnels/index', $data);
    }
    public function prosIndex()
    {
        return view('professionnels/prosIndex');
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
            'mailPros' => 'required|valid_email',
            'mdpPros' => 'required',
        ])) {

            $emailPost = $this->request->getPost("mailPros");
            $passwordPost = $this->request->getPost("mdpPros");

            $professionnels = $this->professionnels->findByEmail($emailPost);
            if (!empty($professionnels)) {
                if (password_verify($passwordPost, $professionnels["mdpPros"])) {
                    session()->set([
                        "professionnels" => true,
                        "id" => $professionnels["id"]
                    ]);
                    return redirect()->to(base_url() . '/profilPros');
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
            'mailPros' => 'required|valid_email|is_unique[professionnels.mailPros]',
            'dateNaissancePros' => 'required',
            'mdpPros' => 'required|min_length[6]|max_length[255]',
            'adresse' => 'required',
            'telPros' => 'required',
            'siret' => 'required',
        ])) {
            $apiUrl = "https://entreprise.data.gouv.fr/api/sirene/v3/etablissements/" . $this->request->getPost("siret");
            $response = file_get_contents($apiUrl, False);
            $result = json_decode($response, true);
            $data_arr = $this->geocode($this->request->getPost("adresse"));

            // if able to geocode the address

            if ($result['etablissement']['siret'] === $this->request->getPost("siret")) {

                if ($data_arr) {

                    $latitude = $data_arr[0];
                    $longitude = $data_arr[1];
                    var_dump($data_arr);

                    $professionnels = [
                        "nomPros" => $this->request->getPost("nomPros"),
                        "prenomPros" => $this->request->getPost("prenomPros"),
                        "mailPros" => $this->request->getPost("mailPros"),
                        "dateNaissancePros" => $this->request->getPost("dateNaissancePros"),
                        "mdpPros" => password_hash($this->request->getPost("mdpPros"), PASSWORD_DEFAULT),
                        "adressePros" => $this->request->getPost("adresse"),
                        "telPros" => $this->request->getPost("telPros"),
                        "siret" => $this->request->getPost("siret"),
                        "latitudePros" => $latitude,
                        "longitudePros" => $longitude
                    ];

                    $this->professionnels->insert($professionnels);
                    var_dump($data_arr);
                    return redirect()->to(base_url() . '/professionnels');
                }
            } else if ($result['etablissement']['siret'] != $this->request->getPost("siret")) {
                echo view("professionnels/inscriptionPros");
                echo "numéro de siret invalide";
            }
        } else {
            echo view("professionnels/inscriptionPros", [
                'validation' => $this->validator
            ]);
        }
    }

    public function contactPros()
    {
        $data = [
            'contact' => $this->messages->displayContact()
        ];

        echo view("professionnels/contactPros", $data);
    }

    public function deconnexionPros()
    {
        session()->destroy();
        return redirect()->to(base_url() . '/professionnels');
    }

    function create()
    {
        if ($this->request->getMethod() === 'post' && $this->validate([
            'date_debut' => 'required',
            'date_fin' => 'required',
            'nbr_place' => 'required',
            'debut_session' => 'required',
            'fin_session' => 'required'
        ])) {
            $data = [
                "debut_session" => $this->request->getPost("debut_session"),
                "fin_session" => $this->request->getPost("fin_session")
            ];
            $debut2 = $data['debut_session'];
            $fin2 = $data['fin_session'];

            $debut = strtotime($this->request->getPost("date_debut"));
            $fin = strtotime($this->request->getPost("date_fin"));
            $dif = ceil(abs($fin - $debut) / 86400);

            $session_creneaux = [
                "creche_id" => session("id"),
                "debutSession" => $this->request->getPost("debut_session"),
                "finSession" => $this->request->getPost("fin_session"),
                "date_debut" => $this->request->getPost("date_debut"),
                "date_fin" => $this->request->getPost("date_fin"),
            ];
            $this->session->insert($session_creneaux);

            $last_id = $this->session->getInsertID();

            if ($dif == 0) {

                for ($i = $debut2; $i < $fin2; $i++) {
                    $data['debut'] = $i;
                    $data['fin'] = $i + 1;

                    $creneau = [
                        "jour" => 1,
                        "date" => $this->request->getPost("date_debut"),
                        "debut" => $data['debut'],
                        "fin" => $data['fin'],
                        "nbr_place" => $this->request->getPost("nbr_place"),
                        "nbr_place_restant" => $this->request->getPost("nbr_place"),
                        "creche_id" => session("id"),
                        "session_id" => $last_id

                    ];
                    $this->creneau->insert($creneau);
                }
                return redirect()->to(base_url() . '/prosIndex');
            } elseif ($dif > 0) {
                for ($i = $debut2; $i < 24; $i++) {
                    $data['debut'] = $i;
                    $data['fin'] = $i + 1;

                    $creneau = [
                        "jour" => 1,
                        "date" => $this->request->getPost("date_debut"),
                        "debut" => $data['debut'],
                        "fin" => $data['fin'],
                        "nbr_place" => $this->request->getPost("nbr_place"),
                        "nbr_place_restant" => $this->request->getPost("nbr_place"),
                        "creche_id" => session("id"),
                        "session_id" => $last_id

                    ];

                    $this->creneau->insert($creneau);
                }
                for ($i = 0; $i < ($dif - 1); $i++) {
                    $nombrejour = $i + 1;
                    $date = date('Y-m-d', strtotime($this->request->getPost("date_debut") . " +" . $nombrejour . " days"));
                    for ($j = 0; $j < 24; $j++) {
                        $data['debut'] = $j;
                        $data['fin'] = $j + 1;

                        $creneau = [
                            "jour" => $i + 2,
                            "date" => $date,
                            "debut" => $data['debut'],
                            "fin" => $data['fin'],
                            "nbr_place" => $this->request->getPost("nbr_place"),
                            "nbr_place_restant" => $this->request->getPost("nbr_place"),
                            "creche_id" => session("id"),
                            "session_id" => $last_id
                        ];

                        $increment = $i + 2;
                        $this->creneau->insert($creneau);
                    }
                }
                for ($i = 0; $i < $fin2; $i++) {
                    if ($dif == 1) {
                        $increment = 1;
                    }
                    $data['debut'] = $i;
                    $data['fin'] = $i + 1;

                    $creneau = [
                        "jour" => $increment + 1,
                        "date" => $this->request->getPost("date_fin"),
                        "debut" => $data['debut'],
                        "fin" => $data['fin'],
                        "nbr_place" => $this->request->getPost("nbr_place"),
                        "nbr_place_restant" => $this->request->getPost("nbr_place"),
                        "creche_id" => session("id"),
                        "session_id" => $last_id
                    ];
                    $this->creneau->insert($creneau);
                }
            }
            return redirect()->to(base_url() . '/profilPros');
        } else {
            echo view("professionnels/create");
        }
    }
    function profilPros()
    {
        $this->professionnels->find(session("id"));
        $data = [
            "data" => $this->professionnels->find(session("id"))

        ];
        return view('professionnels/profilPros', $data);
    }

    function messagesPros($id)
    {
        if ($this->request->getMethod() === 'post' && $this->validate([
            'message' => 'required'

        ])) {


            $message = [
                'id_auteur' => session('id'),
                'id_destinataire' => $id,
                "contenu" => $this->request->getPost("message"),
                "statut" => "pro",

            ];

            $this->messages->insert($message);
            return redirect()->to(base_url() . '/messagesPros/' . $id);
        } else {
            $data = [
                'message' => $this->messages->displayMessages($id)
            ];

            echo view("professionnels/messagesPros", $data);
        }
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
}
