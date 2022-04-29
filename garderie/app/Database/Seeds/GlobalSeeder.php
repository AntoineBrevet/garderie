<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GlobalSeeder extends Seeder
{
    public function run()
    {
        $this->call('parents');
        $this->call('professionnels');
        $this->call('enfants');
        $this->call('session');
        $this->call('creneau');
        $this->call('recupere');
        $this->call('reservation');
    }
}
