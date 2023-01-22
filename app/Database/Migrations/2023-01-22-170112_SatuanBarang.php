<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SatuanBarang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'satuan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('satuan_barang');
    }

    public function down()
    {
        $this->forge->dropTable('satuan_barang');
    }
}
