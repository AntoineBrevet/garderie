<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Parents extends Seeder
{
    public function run()
    {
        $data = [
            'nbr_enfants' => 2,
            'nomParents'    => 'Lepremier',
            'prenomParents' => 'Phillipe',
            'adresse' => '16 rue de la porte 76000 Rouen',
            'mdp' => 'root',
            'mail' => 'phillipe@test.fr',
            'tel' => 665555397,
        ];

        $this->db->table('parents')->insert($data);
    }
}
