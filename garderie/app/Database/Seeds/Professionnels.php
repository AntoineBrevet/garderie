<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Professionnels extends Seeder
{
    public function run()
    {
        $data = [[
            'nomPros'    => 'Lacrecherie',
            'adresse' => '32 rue José Baptisa',
            'siret' => '60212915471833',
            'mdp' => 'root',
            'mail' => 'Lacrecherie@pro.fr',
            'tel' => 666653626,
            'description' => 'description de la creche'
            ],[
            'nomPros'    => 'laguarderie',
            'adresse' => '1 rue Route',
            'siret' => '88842915423456',
            'mdp' => 'root',
            'mail' => 'Laguarderie@pro.fr',
            'tel' => 467735329,
            'description' => 'description de la guarderie'
        ]];

        foreach($data as $datas){
         $this->db->table('professionnels')->insert($datas);
}
   
    }
}
