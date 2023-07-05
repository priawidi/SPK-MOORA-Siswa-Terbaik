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
        $this->forge->createTable('nilai_kriteria',true);
    }

    public function down()
    {
        $this->forge->dropTable('nilai_kriteria');
    }
    
}
