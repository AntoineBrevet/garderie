<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Creneau extends Seeder
{
    public function run()
    {
        $datas = [[
           
            'debut' => 8,
            'fin' => 9,
            'creche_id' => 1,
            'nbr_place' => 25,
            'nbr_place_restant' => 24,
            'session_id' => 1,
        ],
         [
          
            'debut' => 9,
            'fin' => 10,
            'creche_id' => 1,
            'nbr_place' => 25,
            'session_id' => 1,
            'nbr_place_restant' => 24,
         ],
        [

            'debut' => 10,
            'fin' => 11,
            'creche_id' => 1,
            'nbr_place' => 25,
            'session_id' => 1,
            'nbr_place_restant' => 24,
        ], [

            'debut' => 10,
            'fin' => 11,
            'creche_id' => 2,
            'nbr_place' => 25,
            'session_id' => 2,
            'nbr_place_restant' => 24,
        ]];

        foreach($datas as $data){
            $this->db->table('creneau')->insert($data);
        }


    }
}
