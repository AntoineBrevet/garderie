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
            'mdpPros' => password_hash('root', PASSWORD_DEFAULT),
            'mailPros' => 'Lacrecherie@pro.fr',
            'telPros' => 666653626,
            'descriptionPros' => 'description de la creche',
            'latitudePros' => "48.7786183",
            'longitudePros' => "1.2837523",
            ],[
            'nomPros'    => 'laguarderie',
            'adressePros' => '1 rue Route',
            'siret' => '88842915423456',
            'mdpPros' => password_hash('root', PASSWORD_DEFAULT),
            'mailPros' => 'Laguarderie@pro.fr',
            'telPros' => 467735329,
            'descriptionPros' => 'description de la guarderie',
            'latitudePros' => "48.8786183",
            'longitudePros' => "1.0837523",
        ]];

        foreach($data as $datas){
         $this->db->table('professionnels')->insert($datas);
}
   
    }
}
