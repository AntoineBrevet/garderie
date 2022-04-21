<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Recupere extends Migration
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
            'tel'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'nom'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '225',
            ],
            'prenom'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '225',
            ],
            'deleted_at'=> [
                'type'=> 'DATETIME',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default null on update current_timestamp'
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_enfant', 'enfants', 'id');
        $this->forge->createTable('recupere');
        }
        public function down()
        {
            $this->forge->dropTable('recupere'); 
        }
    }
    
