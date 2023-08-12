<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NilaiSiswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_nilai' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'fk_id_kriteria' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'fk_id_siswa' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'nilai' => [
                'type' => 'FLOAT',
                'constraint' => 11,
            ],
            'id_kelas' => [
                'type' => 'VARCHAR',
                'constraint' => 11,
            ],

        ]);
        $this->forge->addKey('id_nilai', true);
        $this->forge->addForeignKey('fk_id_kriteria', 'kriteria', 'id_kriteria', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('fk_id_siswa', 'siswa', 'id_siswa', 'CASCADE', 'CASCADE');
        $this->forge->createTable('nilai_siswa', true);
    }

    public function down()
    {
        $this->forge->dropTable('nilai_siswa');
    }
}
