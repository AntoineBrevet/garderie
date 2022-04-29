<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Session extends Seeder
{
    public function run()
    {
        $datas = [[
            'creche_id' => 1,
            'debutSession' => 8,
            'finSession' => 11,
        ],
        [
            'creche_id' => 2,
            'debutSession' => 10,
            'finSession' => 11,
        ],
    ];

        foreach($datas as $data){ 
        $this->db->table('session')->insert($data);
    }
    }
}
