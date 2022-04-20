<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Reservation extends Migration
{
    public function up(){
    $this->forge->addField([
        'id'          => [
            'type'           => 'INT',
            'constraint'     => 11,
            'unsigned'       => true,
            'auto_increment' => true,   
        ],
        'id_enfant'          => [
            'type'           => 'INT',
            'constraint'     => 11,
            'unsigned'       => true,
        ],
        'id_creneau'          => [
            'type'           => 'INT',
            'constraint'     => 11,
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
    $this->forge->addForeignKey('id_enfants', 'enfants', 'id');
    $this->forge->addForeignKey('id_creneau', 'creneau', 'id');
    $this->forge->createTable('reservation');
    }
    public function down()
    {
        $this->forge->dropTable('reservation'); 
    }
}
