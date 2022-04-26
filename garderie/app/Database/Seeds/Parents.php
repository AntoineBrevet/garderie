<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Parents extends Seeder
{
    public function run()
    {
        $datas = [[
            'nbr_enfants' => 2,
            'nomParents'    => 'Lepremier',
            'prenomParents' => 'Phillipe',
            'adresseParents' => '16 rue de la porte 76000 Rouen',
            'mdpParents' => 'root',
            'mailParents' => 'phillipe@test.fr',
            'telParents' => 665555397,
        ],[
            'nbr_enfants' => 1,
            'nomParents'    => 'Ledeuxieme',
            'prenomParents' => 'John',
            'adresseParents' => '54 rue du renard 76000 Rouen',
            'mdpParents' => 'root',
            'mailParents' => 'John@test.fr',
            'telParents' => 665555397,
        ]];

        foreach($datas as $data){
        $this->db->table('parents')->insert($data);
            
        }
    }
}
