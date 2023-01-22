<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Customer extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'customer_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'customer_email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'customer_address' => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'customer_phone' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('customer');
    }

    public function down()
    {
        $this->forge->dropTable('customer');
    }
}
