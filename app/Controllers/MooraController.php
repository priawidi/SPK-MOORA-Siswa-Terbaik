<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\App;

class MooraController extends BaseController
{
    public function index($id_kelas)
    {
        $username = session('username');
        $data['user_data'] = $this->User->getUserByUsername($username);
        // $data['alternatif'] = $this->Metode->getNilaiSetiapAlternatifByKelas($id_kelas);
        $data['kriteria'] = $this->Metode->getKriteriaById();
        $data['siswa'] = $this->Siswa->getAllSiswaBykelas($id_kelas);
        $data['nilai_siswa'] = $this->Nilai->getAllNilaiSiswa();


        $alternatif = [];
        foreach ($this->Nilai->getAllNilaiSiswaBykelas($id_kelas) as $key => $value) {
            $alternatif[$value['fk_id_siswa']] = $value;
        }
        // dd($alternatif[79]['id_siswa']);
        // $data['alt'] = $alternatif;

        $tranpose = [];

        foreach ($this->Nilai->getNilaiSiswaByKelas($id_kelas) as $key => $value) {

            $tranpose[$value['fk_id_kriteria']][$value['fk_id_siswa']] = $value['nilai'];
            // dd($tranpose[$key]);
        }
        // $data['nilaisiswa'] = $tranpose;
        // dd($tranpose);
        $sqrt   = [];
        foreach ($tranpose as $key => $value) {
            $sum = 0;

            foreach ($value as $k => $val) {
                $sum += pow($val, 2);
            }

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

        // dd($normalisasi);
        // $normalisasi1 = [];
        // $normalisasi1[$] = 

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

        // dd($rankings);


        $result_data = [];
        $i = 1;
        foreach ($rankings as $key => $value) {
            $result_data["" . $value] = $i;
            $i++;
        }
        // dd($result_data);


        $text_rank = [];
        foreach ($tabel_yi as $key => $value) {
            $rank = $result_data["" . $value];
            $siswa[$key]['value'] = $value;
            $siswa[$key]['rank'] = $rank;
            // $siswa[$key]['altt'] = $alternatif;
            $text_rank[] = $siswa[$key];
        }
        // dd($text_rank);

        function compareOrder($a, $b)
        {
            return ($a['rank'] > $b['rank'] ? true : false);
        }
        // usort($text_rank, 'compareOrder');
        $data['sorted_rank_data'] = $text_rank;

        // dd($text_rank);


        //ambil angka dari kelas, misal kelas 7b maka akan diambil angka 7 nya saja
        $firstchar = substr($id_kelas, 0, 1);
        if ($firstchar == 7) {
            return view('admin/siswa/kelas 7/hitung', $data,);
        } elseif ($firstchar == 8) {
            return view('admin/siswa/kelas 8/hitung', $data,);
        } elseif ($firstchar == 9) {
            return view('admin/siswa/kelas 9/hitung', $data,);
        }
    }

    // public function ranking()
    // {
    //     $username = session('username');
    //     $data['user_data'] = $this->User->getUserByUsername($username);
    //     // $data['alternatif'] = $this->Metode->getNilaiSetiapAlternatifByKelas($id_kelas);
    //     $data['kriteria'] = $this->Metode->getKriteriaById();
    //     // $data['siswa'] = $this->Siswa->getAllSiswaBykelas($id_kelas);
    //     $data['nilai_siswa'] = $this->Nilai->getAllNilaiSiswa();

    //     $alternatif = [];
    //     foreach ($this->Nilai->getAllNilaiSiswaBykelas($id_kelas) as $key => $value) {
    //         $alternatif[$value['fk_id_siswa']] = $value;
    //     }
    //     // $data['alt'] = $alternatif;

    //     $tranpose = [];

    //     foreach ($this->Nilai->getNilaiSiswaByKelas($id_kelas) as $key => $value) {
    //         $tranpose[$value['fk_id_kriteria']][$value['fk_id_siswa']] = $value['nilai'];
    //     }
    //     // $data['nilaisiswa'] = $tranpose;
    //     // dd($tranpose);
    //     $sqrt   = [];
    //     foreach ($tranpose as $key => $value) {
    //         $sum = 0;
    //         // dd($value);
    //         foreach ($value as $k => $v) {
    //             $sum += pow($v, 2);
    //         }
    //         // dd($sum);
    //         $sqrt[$key] = sqrt($sum);
    //     }
    //     $data['sqrt'] = $sqrt;

    //     // dd($sqrt);

    //     $normalisasi = [];
    //     foreach ($tranpose as $key => $value) {
    //         foreach ($value as $k => $v) {
    //             $normalisasi[$key][$k] = $v / $sqrt[$key];
    //         }
    //     }
    //     $data['normalisasi'] = $normalisasi;

    //     // dd($normalisasi);

    //     $kriteria = [];
    //     foreach ($this->Kriteria->getKriteria() as $key => $value) {
    //         $kriteria[$value['id_kriteria']] = $value;
    //     }

    //     $ternormalisasi = [];
    //     foreach ($normalisasi as $key => $value) {
    //         foreach ($value as $k => $v) {
    //             $ternormalisasi[$k][$key] = $v * $kriteria[$key]['bobot_nilai'];
    //         }
    //     }
    //     $data['ternormalisasi'] = $ternormalisasi;

    //     // dd($ternormalisasi);

    //     $max = [];
    //     $min = [];
    //     $tabel_yi = [];
    //     foreach ($ternormalisasi as $key => $value) {
    //         $res = 0;
    //         $res2 = 0;
    //         foreach ($value as $a => $b) {
    //             if ($kriteria[$a]['jenis_nilai'] == 1) {
    //                 // $new_only_benefit[$a] = $b ;
    //                 $res += $b;
    //             } else {
    //                 $res -= 0;
    //             }
    //             if ($kriteria[$a]['jenis_nilai'] == 0) {
    //                 // $new_only_benefit[$a] = $b ;
    //                 $res2 += $b;
    //             } else {
    //                 $res2 -= 0;
    //             }
    //         }
    //         $max[$key] = $res;
    //         $min[$key] = $res2;
    //         $tabel_yi[$key] = $res - $res2;
    //     }
    //     $data['max'] = $max;
    //     $data['min'] = $min;
    //     $data['tabel_yi'] = $tabel_yi;
    //     // dd($tabel_yi);

    //     $rankings = array_unique($tabel_yi);
    //     rsort($rankings);

    //     $result_data = [];
    //     $i = 1;
    //     foreach ($rankings as $key => $value) {
    //         $result_data["" . $value] = $i;
    //         $i++;
    //     }


    //     $text_rank = [];
    //     foreach ($tabel_yi as $key => $value) {
    //         $rank = $result_data["" . $value];
    //         $siswa[$key]['value'] = $value;
    //         $siswa[$key]['rank'] = $rank;
    //         // $siswa[$key]['altt'] = $alternatif;
    //         $text_rank[] = $siswa[$key];
    //     }

    //     // function compareOrder($a, $b)
    //     // {
    //     //     return ($a['rank'] > $b['rank'] ? true : false);
    //     // }
    //     // usort($text_rank, 'compareOrder');
    //     $data['sorted_rank_data'] = $text_rank;

    //     // dd($text_rank);


    //     //ambil angka dari kelas, misal kelas 7b maka akan diambil angka 7 nya saja
    //     // $firstchar = substr($id_kelas, 0, 1);
    //     // if ($firstchar == 7) {
    //     //     return view('admin/siswa/kelas 7/hitung', $data,);
    //     // } elseif ($firstchar == 8) {
    //     //     return view('admin/siswa/kelas 8/hitung', $data,);
    //     // } elseif ($firstchar == 9) {
    //     //     return view('admin/siswa/kelas 9/hitung', $data,);
    //     // }
    // }

    // public function test1($id_kelas)
    // {
    //     $username = session('username');
    //     $data['user_data'] = $this->User->getUserByUsername($username);
    //     $data['alternatif'] = $this->Metode->getNilaiSetiapAlternatifByKelas($id_kelas);
    //     $data['kriteria'] = $this->Metode->getKriteriaById();
    //     $data['siswa'] = $this->Siswa->getAllSiswaBykelas($id_kelas);
    //     $data['nilai_siswa'] = $this->Nilai->getAllNilaiSiswa();


    //     $alternatifs = $this->Metode->getNilaiSetiapAlternatifByKelas($id_kelas);
    //     // dd($alternatifs);

    //     $id_kriteria = $this->Metode->getIdKriteria();
    //     // dd($id_kriteria[1]);
    //     $sqrt = [];
    //     foreach ($id_kriteria as $key => $value) {
    //         $normalisasi = $this->Metode->normalisasiNilai($value->id_kriteria);
    //         // dd($normalisasi);
    //         $sqrt[$normalisasi['nilai_pembagian']] = $normalisasi;
    //     }
    //     // dd($sqrt);

    //     $data['sqrt'] = $sqrt;


    //     $nilai = [];
    //     $i = 1;

    //     $pembobotan1 = [];
    //     $pembobotan = [];
    //     foreach ($alternatifs as $key => $value) {
    //         // for ($i = 1; $i <= count($alternatifs); $i++) {
    //         $x = 0;
    //         // dd($value);

    //         foreach ($sqrt as $k => $val) {
    //             // dd($sqrt);
    //             // dd($val['nilai_pembagian']);

    //             $pembobotan = $this->Metode->pembobotanNilai($val['nilai_pembagian'], $id_kriteria[$x]->id_kriteria);
    //             $x++;

    //             $pembobotan1[$pembobotan['fk_id_siswa']][$pembobotan['fk_id_kriteria']] = $pembobotan;
    //         }

    //         $i++;
    //     }
    //     dd($pembobotan1);

    //     $ranking = [];
    //     foreach ($alternatifs as $key => $value) {
    //         $ranking = $this->Metode->hasilNilai($value['id_siswa']);
    //         dd($ranking);
    //     }



    //     //ambil angka dari kelas, misal kelas 7b maka akan diambil angka 7 nya saja
    //     $firstchar = substr($id_kelas, 0, 1);
    //     if ($firstchar == 7) {
    //         return view('admin/siswa/kelas 7/hitung', $data,);
    //     } elseif ($firstchar == 8) {
    //         return view('admin/siswa/kelas 8/hitung', $data,);
    //     } elseif ($firstchar == 9) {
    //         return view('admin/siswa/kelas 9/hitung', $data,);
    //     }
    // }

    // public function test2($id_kelas)
    // {
    // }
}
