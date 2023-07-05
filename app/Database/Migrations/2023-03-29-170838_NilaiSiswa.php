<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NilaiSiswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_kriteria' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'id_siswa' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'role' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        //$this->forge->addForeignKey('id_kriteria','kriteria','id_kriteria','CASCADE','CASCADE');
        //$this->forge->addForeignKey('id_siswa','siswa','id_siswa','CASCADE','CASCADE');
        $this->forge->createTable('nilai_siswa',true);
    }

    public function down()
    {
        $this->forge->dropTable('nilai_siswa');
    }
    
}
