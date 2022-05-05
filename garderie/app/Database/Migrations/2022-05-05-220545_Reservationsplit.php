<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Reservationsplit extends Migration
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
            'nom_reservation'          => [
                'type'           => 'VARCHAR',
                'constraint'     => "255",
            ],
            'debut_reservation'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,

            ],
            'fin_reservation'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,

            ],
            'debut_date_reservation' => [
                'type' => 'DATE',
            ],
            'fin_date_reservation' => [
                'type' => 'DATE',
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default null on update current_timestamp'
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('reservationsplit');
    }

    public function down()
    {
        $this->forge->dropTable('reservationsplit');
    }
}
