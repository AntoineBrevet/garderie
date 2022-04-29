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

    function __construct()
    {
        $this->creneau = model(CreneauModel::class);
        $this->enfants = model(EnfantsModel::class);
        $this->parents = model(ParentsModel::class);
        $this->professionnels = model(ProfessionnelsModel::class);
        $this->reservation = model(ReservationModel::class);
        $this->recupere = model(RecupereModel::class);
        $this->session = model(SessionModel::class);
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
                    return redirect()->to(base_url() . '/prosIndex');
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

            $data_arr = $this->geocode($this->request->getPost("adresse"));

            // if able to geocode the address
            if ($data_arr) {

                $latitude = $data_arr[0];
                $longitude = $data_arr[1];
                $formatted_address = $data_arr[2];
                var_dump($data_arr);
?>
                <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyCHIY60MQ8Vyb5e7bM4P4_i5HsIcTr-kHw"></script>
                <script type="text/javascript">
                    function init_map() {
                        var myOptions = {
                            zoom: 14,
                            center: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>),
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        };
                        map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
                        marker = new google.maps.Marker({
                            map: map,
                            position: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>)
                        });
                        infowindow = new google.maps.InfoWindow({
                            content: "<?php echo $formatted_address; ?>"
                        });
                        google.maps.event.addListener(marker, "click", function() {
                            infowindow.open(map, marker);
                        });
                        infowindow.open(map, marker);
                    }
                    google.maps.event.addDomListener(window, 'load', init_map);
                </script>

<?php


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
        } else {
            echo view("professionnels/inscriptionPros", [
                'validation' => $this->validator
            ]);
        }
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

            if ($dif == 0) {
                for ($i = $debut2; $i < $fin2; $i++) {
                    $data['debut'] = $i;
                    $data['fin'] = $i + 1;
                    $creneau = [
                        "jour" => 1,
                        "date_debut" => $this->request->getPost("date_debut"),
                        "date_fin" => $this->request->getPost("date_fin"),
                        "debut" => $data['debut'],
                        "fin" => $data['fin'],
                        "nbr_place" => $this->request->getPost("nbr_place"),
                        "nbr_place_restant" => $this->request->getPost("nbr_place"),
                        "debut_session" => $this->request->getPost("debut_session"),
                        "fin_session" => $this->request->getPost("fin_session"),
                        "creche_id" => session("id")
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
                        "date_debut" => $this->request->getPost("date_debut"),
                        "date_fin" => $this->request->getPost("date_fin"),
                        "debut" => $data['debut'],
                        "fin" => $data['fin'],
                        "nbr_place" => $this->request->getPost("nbr_place"),
                        "nbr_place_restant" => $this->request->getPost("nbr_place"),
                        "debut_session" => $this->request->getPost("debut_session"),
                        "fin_session" => $this->request->getPost("fin_session"),
                        "creche_id" => session("id")
                    ];
                    $this->creneau->insert($creneau);
                }
                for ($i = 0; $i < ($dif - 1); $i++) {
                    for ($j = 0; $j < 24; $j++) {
                        $data['debut'] = $j;
                        $data['fin'] = $j + 1;
                        $creneau = [
                            "jour" => $i + 2,
                            "date_debut" => $this->request->getPost("date_debut"),
                            "date_fin" => $this->request->getPost("date_fin"),
                            "debut" => $data['debut'],
                            "fin" => $data['fin'],
                            "nbr_place" => $this->request->getPost("nbr_place"),
                            "nbr_place_restant" => $this->request->getPost("nbr_place"),
                            "debut_session" => $this->request->getPost("debut_session"),
                            "fin_session" => $this->request->getPost("fin_session"),
                            "creche_id" => session("id")
                        ];
                        $id = $i + 2;
                        $this->creneau->insert($creneau);
                    }
                }
                for ($i = 1; $i < $fin2; $i++) {
                    if ($dif == 1) {
                        $id = 1;
                    }
                    $data['debut'] = $i;
                    $data['fin'] = $i + 1;
                    $creneau = [
                        "jour" => $id + 1,
                        "date_debut" => $this->request->getPost("date_debut"),
                        "date_fin" => $this->request->getPost("date_fin"),
                        "debut" => $data['debut'],
                        "fin" => $data['fin'],
                        "nbr_place" => $this->request->getPost("nbr_place"),
                        "nbr_place_restant" => $this->request->getPost("nbr_place"),
                        "debut_session" => $this->request->getPost("debut_session"),
                        "fin_session" => $this->request->getPost("fin_session"),
                        "creche_id" => session("id")
                    ];
                    $this->creneau->insert($creneau);
                }
            }
            return redirect()->to(base_url() . '/prosIndex');
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
