<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BarangMasuk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'supplier_id' => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'barang_id' => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'qty' => [
                'type'           => 'INTEGER',
                'constraint'     => '11',
            ],
            'user_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'tanggal' => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
            ],
            'no_bulan' => [
                'type'       => 'VARCHAR',
                'constraint' => '2',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('barang_masuk');
    }

    public function down()
    {
        $this->forge->dropTable('barang_masuk');
    }
}
