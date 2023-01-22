<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Supplier extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'supplier_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'supplier_email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'supplier_address' => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'supplier_phone' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('supplier');
    }

    public function down()
    {
        $this->forge->dropTable('supplier');
    }
}
