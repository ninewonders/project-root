<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateDevisTable extends Migration
{
    public function up()
    {
        $fields=[
            'id' => ['type' => 'INT','usigned'=>true, 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'nom' => ['type' => 'VARCHAR', 'constraint' => 200],
            'prix' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'desc' => ['type' => 'VARCHAR', 'constraint' => 200],
            'created_at' => ['type'    => 'TIMESTAMP','default' => new RawSql('CURRENT_TIMESTAMP')],
            'updated_at' => ['type' => 'TIMESTAMP','default' => NULL],
            'deleted_at' => ['type' => 'TIMESTAMP','default' => NULL]
        ];
        
        $this->forge->addField($fields);
        $this->forge->addKey('id', true);
        $this->forge->createTable('devis');
    }

    public function down()
    {
        $this->forge->dropTable('devis');
    }
}