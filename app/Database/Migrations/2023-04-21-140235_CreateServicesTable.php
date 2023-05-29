<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateServicesTable extends Migration
{
    public function up()
    {
        $fields =[
            'id' => ['type' => 'INT','usigned'=>true, 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'nom' => ['type' => 'VARCHAR', 'constraint' => 200],
            'desc' => ['type' => 'VARCHAR', 'constraint' => 200],
            'prix_unitaire' => ['type' => 'decimal', 'constraint' => '10,2'],
            'created_at' => ['type'    => 'TIMESTAMP','default' => NULL],
            'updated_at' => ['type' => 'TIMESTAMP','default' => NULL],
            'deleted_at' => ['type' => 'TIMESTAMP','default' => NULL]
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('id', true);
        $this->forge->createTable('services');
    }

    public function down()
    {
        $this->forge->dropTable('services');
    }
}