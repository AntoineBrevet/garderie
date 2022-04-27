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
            'nomPros'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'prenomPros'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'dateNaissancePros' => [
                'type' => 'DATE',
            ],
            'mailPros'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'mdpPros'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'telPros'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'adressePros'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255'
            ],
            'siret'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255'
            ],
            'descriptionPros'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255'
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'latitudePros'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'longitudePros'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
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
