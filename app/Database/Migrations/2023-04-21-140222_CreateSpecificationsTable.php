<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateSpecificationsTable extends Migration
{
    public function up()
    {

        $fields =[
            'id' => ['type' => 'INT','usigned'=>true, 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'id_serveur' =>['type' => 'INT','usigned'=>true, 'constraint' => 5, 'unsigned' => true],
            'id_service' =>['type' => 'INT','usigned'=>true, 'constraint' => 5, 'unsigned' => true],
            'quantite' => ['type' => 'INT', 'constraint' => '10'],
            'prix_unitaire' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'prix' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'created_at' => ['type'    => 'TIMESTAMP','default' => new RawSql('CURRENT_TIMESTAMP')],
            'updated_at' => ['type' => 'TIMESTAMP','default' => NULL],
            'deleted_at' => ['type' => 'TIMESTAMP','default' => NULL]
        ];
        
        $this->forge->addField($fields);
        $this->forge->addKey('id', true);
        $this->forge->createTable('specifications');
        $sql = "ALTER TABLE specifications ADD CONSTRAINT FOREIGN KEY (id_serveur) REFERENCES serveurs(id) ON DELETE CASCADE"; 
        $this->db->query($sql);
    }

    public function down()
    {
        $this->forge->dropTable('specifications');
    }
}