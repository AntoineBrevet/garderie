<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Professionnels extends Seeder
{
    public function run()
    {
        $data = [[
            'nomPros'    => 'Lacrecherie',
            'adressePros' => '32 rue José Baptisa',
            'siret' => '60212915471833',
            'mdpPros' => 'root',
            'mailPros' => 'Lacrecherie@pro.fr',
            'telPros' => 666653626,
            'descriptionPros' => 'description de la creche'
            ],[
            'nomPros'    => 'laguarderie',
            'adressePros' => '1 rue Route',
            'siret' => '88842915423456',
            'mdpPros' => 'root',
            'mailPros' => 'Laguarderie@pro.fr',
            'telPros' => 467735329,
            'descriptionPros' => 'description de la guarderie'
        ]];

        foreach($data as $datas){
         $this->db->table('professionnels')->insert($datas);
}
   
    }
}
