<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Professionnels extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,   
            ],
            'nom'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'adresse'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255'
            ],
            'siret'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255'
            ],
          'description'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255'
            ],
            'deleted_at'=> [
                'type'=> 'DATETIME',
                'null' => true,
            ],

            'created_at datetime default current_timestamp',
            'updated_at datetime default null on update current_timestamp'
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('professionnels');
    }

    public function down()
    {
        $this->forge->dropTable('professionnels');   
    }
}