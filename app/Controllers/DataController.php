<?php

namespace App\Controllers;

use App\Controllers\BaseController;


class DataController extends BaseController
{
    protected $idSis;
    public function importxls()
    {
        return view('importxls');
    }

    public function save_excel($kelas)
    {
        $file_excel = $this->request->getFile('fileexcel');
        $ext = $file_excel->getClientExtension();
        if ($ext == 'xls') {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $spreadsheet = $render->load($file_excel);
        $worksheet = $spreadsheet->getActiveSheet()->toArray();

        // remove header
        for ($i = 0; $i <= 6; $i++) {
            unset($worksheet[$i]);
        }
        // dd($worksheet);
        // ambil id angkatan dari user yang lagi login
        foreach ($worksheet as $col) {
            $Nis = $col[1];
            $NamaSiswa = $col[2];

            $Pengetahuan = $col[43];
            $Keterampilan = $col[44];
            $Absen = $col[45] + $col[46] + $col[47];
            // dd($Absen);
            $Ekskul1 = $col[49];

            $Ekskul2 = $col[51];
            if ($Ekskul1 == 'SB') {
                $Ekskul1 = 4;
            } elseif ($Ekskul1 == 'B') {
                $Ekskul1 = 3;
            }
            if ($Ekskul2 == '-') {
                $Ekskul2 = 0;
            } elseif ($Ekskul2 == 'SB') {
                $Ekskul2 = 4;
            } elseif ($Ekskul2 == 'B') {
                $Ekskul2 = 3;
            }

            settype($Ekskul1, "integer");
            settype($Ekskul2, "integer");
            $Ekskul =  $Ekskul1 + $Ekskul2;
            // dd($Ekskul);

            $Sikap = $col[58];
            if ($Sikap == 'SB') {
                $Sikap = 4;
            }
            if ($Sikap == 'B') {
                $Sikap = 3;
            }
            // dd($Sikap);
            $DataNilai = array($Pengetahuan, $Keterampilan, $Absen, $Ekskul, $Sikap);

            $db = \Config\Database::connect();
            $cekNis = $db->table('siswa')->getWhere(['nis' => $Nis, 'kelas' => $kelas])->getResult();
            //dapetin id siswa
            // dd($cekNis);

            // dd($idSis);

            //cek kalau data yang diimport double
            if (count($cekNis) > 0) {
                session()->setFlashdata('message', '<b style="color:red">Data Gagal di Import NIS ada yang sama</b>');
                continue;
            } else {
                $simpandata = [
                    'nis' => $Nis,
                    'nama_siswa' => $NamaSiswa,
                    'kelas' => $kelas
                ];
                $db->table('siswa')->insert($simpandata);
                $count = count($DataNilai);
                $cekNis = $db->table('siswa')->getWhere(['nis' => $Nis, 'kelas' => $kelas])->getResult();
                foreach ($cekNis as $cs) {
                    $idSis = $cs->id_siswa;
                }
                for ($i = 1; $i <= $count; $i++) {
                    $x = $i - 1;
                    $simpannilai = [
                        'fk_id_kriteria' => $i,
                        'fk_id_siswa' => $idSis,
                        'nilai' => $DataNilai[$x],
                        'id_kelas' => $kelas,
                    ];
                    $this->Nilai->insertNilaiSiswaData($simpannilai);
                }
            }
        }
        session()->setFlashdata('success_alert', 'Berhasil import excel');
        return redirect()->to('/datasiswa' . '/' . $kelas);
    }
}
