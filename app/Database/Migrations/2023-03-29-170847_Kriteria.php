<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kriteria extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kriteria' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_kriteria' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
            'kode_kriteria' => [
                'type' => 'VARCHAR',
                'constraint' => 8,
            ],
            'jenis_nilai' => [
                'type' => 'INT',
                'constraint' => 8,
            ],
            'bobot_nilai' => [
                'type' => 'float',
            ],

        ]);
        $this->forge->addKey('id_kriteria', true);
        $this->forge->createTable('kriteria', true);
    }

    public function down()
    {
        $this->forge->dropTable('kriteria');
    }
}
