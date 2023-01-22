<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Barang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'barang_code' => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'barang_name' => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'barang_deskripsi' => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'barang_stock' => [
                'type'           => 'INTEGER',
                'constraint'     => '11',
            ],
            'tanggal' => [
                'type'       => 'TEXT',
                'constraint' => '100',
                'null' => true,
            ],
            'rak_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'jenis_barang_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'satuan_barang_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'supplier_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('barang');
    }

    public function down()
    {
        $this->forge->dropTable('barang');
    }
}
