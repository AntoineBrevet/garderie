<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Recupere extends Seeder
{
    public function run()
    {
        $datas = [[
            'id_enfant' => 1,
            'nom' => 'M.',
            'prenom' => 'One',
            'tel' => 123456789
        ],
        [
            'id_enfant' => 2,
            'nom' => 'Mm.',
            'tel' => 123456789,
            'prenom' => 'Two',
        ]];

        foreach($datas as $data){ 
        $this->db->table('recupere')->insert($data);
    }
    }
}
