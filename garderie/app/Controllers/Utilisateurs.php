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
        session()->destroy();
        return view('pages/accueil');
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
        }
    else {
        $data = [
            "localisation" => $this->professionnels->call_pro_by_localisation(),
            "position" => $this->parents->find(session("id"))
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
                return redirect()->to('/');
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


    public function geocode($address){


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
