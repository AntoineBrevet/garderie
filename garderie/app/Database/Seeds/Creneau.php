<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Creneau extends Seeder
{
    public function run()
    {
        $datas = [[
            'date_debut' => date('d-m-y'),
            'date_fin' => date('d-m-y'),
            'debut' => 8,
            'fin' => 9,
            'creche_id' => 1,
            'nbr_place' => 25,
            'nbr_place_restant' => 24,
            'debut_session' => 8,
            'fin_session' =>11,
        ],
         [
            'date_debut' => date('d-m-y'),
            'date_fin' => date('d-m-y'),            
            'debut' => 9,
            'fin' => 10,
            'creche_id' => 1,
            'nbr_place' => 25,
            'debut_session' => 8,
            'fin_session' =>11,
            'nbr_place_restant' => 24,
         ],
        [
            'date_debut' => date('d-m-y'),
            'date_fin' => date('d-m-y'),
            'debut' => 10,
            'fin' => 11,
            'creche_id' => 1,
            'nbr_place' => 25,
            'debut_session' => 8,
            'fin_session' =>11,
            'nbr_place_restant' => 24,
        ], [
            'date_debut' => date('d-m-y'),
            'date_fin' => date('d-m-y'),
            'debut' => 10,
            'fin' => 11,
            'creche_id' => 2,
            'nbr_place' => 25,
            'debut_session' => 8,
            'fin_session' =>12,
            'nbr_place_restant' => 24,
        ]];

        foreach($datas as $data){
            $this->db->table('creneau')->insert($data);
        }


    }
}
