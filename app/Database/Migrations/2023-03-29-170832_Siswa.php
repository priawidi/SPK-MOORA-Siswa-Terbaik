<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Siswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_siswa' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_siswa' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
            'nis' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
            'kelas' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
            'jenis_kelamin' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
            'alamat' => [
                'type' => 'TEXT',
                'constraint' => 128,
            ],
            'no_telepon' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],

        ]);
        $this->forge->addKey('id_siswa', true);
        $this->forge->createTable('siswa', true);
    }

    public function down()
    {
        $this->forge->dropTable('siswa');
    }
}
