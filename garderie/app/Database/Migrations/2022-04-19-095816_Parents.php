<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Parents extends Migration
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
            'nbr_enfants'          => [
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
            'adresse'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255'
            ],
            'mdp'          => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'mail'          => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'tel'          => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'       => true,

            ],
            'deleted_at'=> [
                'type'=> 'DATETIME',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default null on update current_timestamp'
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('parents');
    }

    public function down()
    {
        $this->forge->dropTable('parents');   
    }
}
