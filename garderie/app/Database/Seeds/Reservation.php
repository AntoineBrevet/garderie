<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Reservation extends Seeder
{
    public function run()
    {
        $datas = [[
            'id_enfant' => 1,
            'id_creneau' => 2,
        ],
        [
            'id_enfant' => 2,
            'id_creneau' => 3,
        ],
        [
            'id_enfant' => 2,
            'id_creneau' => 4,
        ]];

        foreach($datas as $data){ 
        $this->db->table('reservation')->insert($data);
    }
}
}
