<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Recupere extends Seeder
{
    public function run()
    {
        $datas = [[
            'id_enfant' => 1,
            'nomRecup' => 'M.',
            'prenomRecup' => 'One',
            'telRecup' => 123456789
        ],
        [
            'id_enfant' => 2,
            'nomRecup' => 'Mm.',
            'telRecup' => 123456789,
            'prenomRecup' => 'Two',
        ]];

        foreach($datas as $data){ 
        $this->db->table('recupere')->insert($data);
    }
    }
}
