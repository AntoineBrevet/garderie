<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Professionnels extends Seeder
{
    public function run()
    {
        $data = [
            'nom'    => 'Lacrecherie',
            'adresse' => '32 rue José Baptisa',
            'siret' => '60212915471833',
            'mdp' => 'root',
            'mail' => 'Lacrecherie@pro.fr',
            'tel' => 666653626,
            'description' => 'description de la creche'
        ];

        $this->db->table('professionnels')->insert($data);
    }
}
