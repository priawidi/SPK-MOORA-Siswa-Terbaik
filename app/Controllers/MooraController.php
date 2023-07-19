<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\App;

class MooraController extends BaseController
{
    public function index()
    {
        $username = session('username');
        $data['user_data'] = $this->User->getUserByUsername($username);
        $data['alternatif'] = $this->Metode->getNilaiSetiapAlternatif();
        $data['kriteria'] = $this->Metode->getKriteriaById();
        $data['nilai'] = $this->Metode->getAllNilai();
        $data['siswa'] = $this->Siswa->getAllSiswa();
        $data['nilai_siswa'] = $this->Nilai->getAllNilaiSiswa();
        // $data['alternatif_id'] = $this->Metode->getNilaiSetiapAlternatifById('$id_siswa', '$id_kriteria');

        // $db = db_connect('default');
        $alternatif = [];
        foreach ($this->Nilai->getAllNilaiSiswa() as $key => $value) {
            $alternatif[$value['fk_id_siswa']] = $value;
        }
        $data['alt'] = $alternatif;

        $tranpose = [];
        foreach ($this->Nilai->getNilaiSiswa() as $key => $value) {
            $tranpose[$value['fk_id_kriteria']][$value['fk_id_siswa']] = $value['nilai'];
        }

        // $tranpose = array_map(null, ...$tranpose);
        $data['nilaisiswa'] = $tranpose;

        // dd($tranpose);




        $sqrt   = [];
        foreach ($tranpose as $key => $value) {
            $sum = 0;
            foreach ($value as $k => $v) {
                $sum += pow($v, 2);
            }
            // dd($sum);
            $sqrt[$key] = sqrt($sum);
        }
        $data['sqrt'] = $sqrt;

        // dd($sqrt);

        $normalisasi = [];
        foreach ($tranpose as $key => $value) {
            foreach ($value as $k => $v) {
                $normalisasi[$key][$k] = $v / $sqrt[$key];
            }
        }
        $data['normalisasi'] = $normalisasi;

        // $normalisasi = array_map(null, ...$normalisasi);

        // dd($normalisasi);


        $kriteria = [];
        foreach ($this->Kriteria->getKriteria() as $key => $value) {
            $kriteria[$value['id_kriteria']] = $value;
        }

        $ternormalisasi = [];
        foreach ($normalisasi as $key => $value) {
            foreach ($value as $k => $v) {
                $ternormalisasi[$k][$key] = $v * $kriteria[$key]['bobot_nilai'];
            }
        }
        $data['ternormalisasi'] = $ternormalisasi;


        // dd($ternormalisasi);



        $max = [];
        $min = [];
        $tabel_yi = [];
        foreach ($ternormalisasi as $key => $value) {
            $res = 0;
            $res2 = 0;
            foreach ($value as $a => $b) {
                if ($kriteria[$a]['jenis_nilai'] == 1) {
                    // $new_only_benefit[$a] = $b ;
                    $res += $b;
                } else {
                    $res -= 0;
                }
                if ($kriteria[$a]['jenis_nilai'] == 0) {
                    // $new_only_benefit[$a] = $b ;
                    $res2 += $b;
                } else {
                    $res2 -= 0;
                }
            }
            $max[$key] = $res;
            $min[$key] = $res2;
            $tabel_yi[$key] = $res - $res2;
        }
        $data['max'] = $max;
        $data['min'] = $min;
        $data['tabel_yi'] = $tabel_yi;



        // dd($tabel_yi);


        $rankings = array_unique($tabel_yi);
        rsort($rankings);

        $result_data = [];
        $i = 1;
        foreach ($rankings as $key => $value) {
            $result_data["" . $value] = $i;
            $i++;
        }


        $text_rank = [];
        foreach ($tabel_yi as $key => $value) {
            $rank = $result_data["" . $value];
            $siswa[$key]['value'] = $value;
            $siswa[$key]['rank'] = $rank;
            $siswa[$key]['altt'] = $alternatif;
            $text_rank[] = $siswa[$key];
        }

        function compareOrder($a, $b)
        {
            return ($a['rank'] > $b['rank'] ? true : false);
        }
        // usort($text_rank, 'compareOrder');
        $data['sorted_rank_data'] = $text_rank;
        // echo '<pre>';
        // dd($text_rank);
        // die();

        return view('admin/nilai/hitung', $data);
    }
}
