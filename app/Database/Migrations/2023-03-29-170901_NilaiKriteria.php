<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NilaiKriteria extends Migration
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
            'nilai' => [
                'type' => 'FLOAT',

            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('nilai_kriteria', true);
    }

    public function down()
    {
        $this->forge->dropTable('nilai_kriteria');
    }
}
