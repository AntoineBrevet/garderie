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
            'dateNaissanceParents' => [
                'type' => 'DATE',
            ],
            'nbr_enfants'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'nomParents'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'prenomParents'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'adresseParents'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255'
            ],
            'mdpParents'          => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'mailParents'          => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'telParents'          => [
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
