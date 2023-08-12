<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Kriteria extends Seeder
{
    public function run()
    {
        $kriteria_data = [
            [
                'nama_kriteria' => 'Pengetahuan',
                'kode_kriteria' => 'C1',
                'jenis_nilai' => '1',
                'bobot_nilai' => '0.5'
            ],
            [
                'nama_kriteria' => 'Keterampilan',
                'kode_kriteria' => 'C2',
                'jenis_nilai' => '1',
                'bobot_nilai' => '0.2'
            ],
            [
                'nama_kriteria' => 'Absensi',
                'kode_kriteria' => 'C3',
                'jenis_nilai' => '0',
                'bobot_nilai' => '0.05'
            ],
            [
                'nama_kriteria' => 'Ekstrakurikuler',
                'kode_kriteria' => 'C4',
                'jenis_nilai' => '1',
                'bobot_nilai' => '0.05'
            ],
            [
                'nama_kriteria' => 'Sikap',
                'kode_kriteria' => 'C5',
                'jenis_nilai' => '1',
                'bobot_nilai' => '0.2'
            ],


        ];


        foreach ($kriteria_data as $data) {
            // insert semua data ke tabel
            $this->db->table('kriteria')->insert($data);
        }
    }
}
