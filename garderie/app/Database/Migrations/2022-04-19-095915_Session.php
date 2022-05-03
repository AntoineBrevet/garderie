<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Session extends Migration
{
    public function up(){
    $this->forge->addField([
        'id'          => [
            'type'           => 'INT',
            'constraint'     => 11,
            'unsigned'       => true,
            'auto_increment' => true,   
        ],
        'creche_id'          => [
            'type'           => 'INT',
            'constraint'     => 11,
            'unsigned'       => true,
        ],
        'debutSession'          => [
            'type'           => 'INT',
            'constraint'     => 11,
            'unsigned'       => true,

        ],
        'finSession'          => [
            'type'           => 'INT',
            'constraint'     => 11,
            'unsigned'       => true,

        ],  
        'date_debut'=> [
            'type'=> 'DATE',
        ],
        'date_fin'=> [
            'type'=> 'DATE',
        ],
        'deleted_at'=> [
            'type'=> 'DATETIME',
            'null' => true,
        ],
        'created_at datetime default current_timestamp',
        'updated_at datetime default null on update current_timestamp'
    ]);
    $this->forge->addKey('id', true);
    $this->forge->addForeignKey('creche_id', 'professionnels', 'id');
    $this->forge->createTable('session');
    }
    public function down()
    {
        $this->forge->dropTable('session'); 
    }
}

