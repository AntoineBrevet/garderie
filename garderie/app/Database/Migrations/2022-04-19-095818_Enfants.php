<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Enfants extends Migration
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
            'parents_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'nom'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'prenom'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'recup_name'          => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'age'          => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'       => true,
            ],
            'sexe'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'allergies'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],            
            'medicaments'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'deleted_at'=> [
                'type'=> 'DATETIME',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default null on update current_timestamp'
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('parents_id', 'parents', 'id');
        $this->forge->createTable('enfants');
    }

    public function down()
    {
        $this->forge->dropTable('enfants');   
    }
}




