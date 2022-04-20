<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Enfants extends Seeder
{
    public function run()
    {
        $datas =[ [
            'parents_id' => 1,
            'nom'    => 'Lepremier',
            'prenom' => 'Lucas',
            'recup_name' => 'Lepremier Phillipe, Lepremier Nathalie',
            'age' => 4,
            'sexe' => 'masculin',
            'allergies' => 'aucune',
            'medicaments' => 'aucun',
        ]
        ,
        [
            'parents_id' => 1,
            'nom'    => 'Lepremier',
            'prenom' => 'Jade',
            'recup_name' => 'Lepremier Phillipe, Lepremier Nathalie',
            'age' => 5,
            'sexe' => 'feminin',
            'allergies' => 'pollen',
            'medicaments' => 'cetirizine matin/soir'
        ]];

        foreach($datas as $data){
        $this->db->table('enfants')->insert($data);
    }
    }
}
