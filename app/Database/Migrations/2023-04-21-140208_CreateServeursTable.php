<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateServeursTable extends Migration
{
    public function up()
    {
        $fields = [
            'id' => ['type' => 'INT','usigned'=>true, 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'id_devis' =>['type' => 'INT','usigned'=>true, 'constraint' => 5, 'unsigned' => true],
            'prix' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'created_at' => ['type'    => 'TIMESTAMP','default' => new RawSql('CURRENT_TIMESTAMP')],
            'updated_at' => ['type' => 'TIMESTAMP','default' => NULL],
            'deleted_at' => ['type' => 'TIMESTAMP','default' => NULL]
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('id', true);
        $this->forge->createTable('serveurs');

        $sql = "ALTER TABLE serveurs ADD CONSTRAINT FOREIGN KEY (id_devis) REFERENCES devis(id) ON DELETE CASCADE"; 
        $this->db->query($sql);
    }

    public function down()
    {
        $this->forge->dropTable('serveurs');
    }
}