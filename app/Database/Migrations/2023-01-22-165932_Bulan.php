<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Bulan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'bulan' => [
                'type'       => 'VARCHAR',
                'constraint' => '18',
                'null' => true,
            ],
            'no' => [
                'type'       => 'INTEGER',
                'constraint' => '2',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('bulan_statis');
    }

    public function down()
    {
        $this->forge->dropTable('bulan_statis');
    }
}
