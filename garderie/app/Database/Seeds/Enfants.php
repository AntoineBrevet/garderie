<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Enfants extends Seeder
{
    public function run()
    {
        $datas =[ [
            'parents_id' => 1,
            'nomEnfants'    => 'Lepremier',
            'prenomEnfants' => 'Lucas',
            'sexeEnfants' => 'masculin',
            'allergies' => 'aucune',
            'medicaments' => 'aucun',
        ]
        ,
        [
            'parents_id' => 1,
            'nomEnfants'    => 'Lepremier',
            'prenomEnfants' => 'Jade',
            'sexeEnfants' => 'feminin',
            'allergies' => 'pollen',
            'medicaments' => 'cetirizine matin/soir'
        ],      
        [
            'parents_id' => 2,
            'nomEnfants'    => 'Ledeuxieme',
            'prenomEnfants' => 'Axelle',
            'sexeEnfants' => 'feminin',
            'allergies' => 'lait',
            'medicaments' => '//'
        ]];

        foreach($datas as $data){
        $this->db->table('enfants')->insert($data);
    }
    }
}
