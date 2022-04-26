<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Creneau extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'date'=> [
                'type'=> 'DATE',
            ],
            'debut'=> [
                'type'=> 'INT',
                'constraint' => 11,
            ],
            'fin'=> [
                'type'=> 'INT',
                'constraint' => 11,
            ],
            'creche_id'=> [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'nbr_place'=> [
                'type'=> 'INT',
                'constraint' => 11,
                'unsigned'       => true,
            ],
            'nbr_place_restant'=> [
                'type'=> 'INT',
                'constraint' => 11,
                'unsigned'       => true,
            ],
            'idCreneau'=> [
                'type'=> 'INT',
                'constraint' => 11,
                'unsigned'       => true,
                'auto_increment' => true,   
            ],
            'debut_session'=>[
                'type'=> 'INT',
                'constraint' => 11,
                'unsigned'       => true,
            ],           
             'fin_session'=>[
                'type'=> 'INT',
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
        $this->forge->addKey('idCreneau', true);
        $this->forge->addForeignKey('creche_id', 'professionnels', 'idPros');
        $this->forge->createTable('creneau');
    }

    public function down()
    {
        $this->forge->dropTable('creneau');    
    }
}