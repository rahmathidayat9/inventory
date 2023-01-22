<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Rak extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'rak_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('rak');
    }

    public function down()
    {
        $this->forge->dropTable('rak');
    }
}
