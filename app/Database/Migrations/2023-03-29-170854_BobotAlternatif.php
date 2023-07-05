<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BobotAlternatif extends Migration
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
            'nilai_bobot' => [
                'type' => 'FLOAT',
            ],

        ]);
        $this->forge->addKey('id', true);
        //$this->forge->addForeignKey('id_kriteria','kriteria','id_kriteria','CASCADE','CASCADE');
        //$this->forge->addForeignKey('id_siswa','siswa','id_siswa','CASCADE','CASCADE');
        $this->forge->createTable('bobot_alternatif', true);
    }

    public function down()
    {
        $this->forge->dropTable('bobot_alternatif');
    }
}
