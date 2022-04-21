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
