<?php

namespace App\Controllers;

use App\Controllers\BaseController;

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

        $normalisasi1 = call_user_func_array('array_map', array_merge(array(NULL), $normalisasi));
        $data['normalisasi'] = $normalisasi1;

        // dd($normalisasi1);

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


        $data['sorted_rank_data'] = $text_rank;

        // dd($text_rank);


        //ambil angka dari kelas, misal kelas 7b maka akan diambil angka 7 nya saja
        $role = session('role');
        $data['role'] = $role;

        $firstchar = substr($id_kelas, 0, 1);

        if ($firstchar == 7) {
            return view('admin/siswa/kelas 7/hitung', $data,);
        } elseif ($firstchar == 8) {
            return view('admin/siswa/kelas 8/hitung', $data,);
        } elseif ($firstchar == 9) {
            return view('admin/siswa/kelas 9/hitung', $data,);
        }

        // if ($role == 1) {
        //     if ($firstchar == 7) {
        //         return view('admin/siswa/kelas 7/hitung', $data,);
        //     } elseif ($firstchar == 8) {
        //         return view('admin/siswa/kelas 8/hitung', $data,);
        //     } elseif ($firstchar == 9) {
        //         return view('admin/siswa/kelas 9/hitung', $data,);
        //     }
        // }
        // if ($role == 2) {
        //     if ($firstchar == 7) {
        //         return view('guru/siswa/kelas 7/hitung', $data,);
        //     } elseif ($firstchar == 8) {
        //         return view('guru/siswa/kelas 8/hitung', $data,);
        //     } elseif ($firstchar == 9) {
        //         return view('guru/siswa/kelas 9/hitung', $data,);
        //     }
        // }
    }

    public function rank()
    {
        $username = session('username');
        $data['user_data'] = $this->User->getUserByUsername($username);
        $data['kriteria'] = $this->Metode->getKriteriaById();
        $data['siswa7'] = $this->Siswa->getAllSiswaBykelas(7);
        $data['siswa8'] = $this->Siswa->getAllSiswaBykelas(8);
        $data['siswa9'] = $this->Siswa->getAllSiswaBykelas(9);
        $data['nilai_siswa'] = $this->Nilai->getAllNilaiSiswa();

        $tranpose7 = [];
        $tranpose8 = [];
        $tranpose9 = [];
        foreach ($this->Nilai->getNilaiSiswaByKelas(7) as $key => $value) {
            $tranpose7[$value['fk_id_kriteria']][$value['fk_id_siswa']] = $value['nilai'];
        }
        foreach ($this->Nilai->getNilaiSiswaByKelas(8) as $key => $value) {
            $tranpose8[$value['fk_id_kriteria']][$value['fk_id_siswa']] = $value['nilai'];
        }
        foreach ($this->Nilai->getNilaiSiswaByKelas(9) as $key => $value) {
            $tranpose9[$value['fk_id_kriteria']][$value['fk_id_siswa']] = $value['nilai'];
        }

        $sqrt7   = [];
        $sqrt8   = [];
        $sqrt9   = [];
        foreach ($tranpose7 as $key => $value) {
            $sum = 0;
            foreach ($value as $k => $val) {
                $sum += pow($val, 2);
            }
            $sqrt7[$key] = sqrt($sum);
        }
        foreach ($tranpose8 as $key => $value) {
            $sum = 0;
            foreach ($value as $k => $val) {
                $sum += pow($val, 2);
            }
            $sqrt8[$key] = sqrt($sum);
        }
        foreach ($tranpose9 as $key => $value) {
            $sum = 0;
            foreach ($value as $k => $val) {
                $sum += pow($val, 2);
            }
            $sqrt9[$key] = sqrt($sum);
        }

        $data['sqrt7'] = $sqrt7;
        $data['sqrt8'] = $sqrt8;
        $data['sqrt9'] = $sqrt9;

        $normalisasi7 = [];
        $normalisasi8 = [];
        $normalisasi9 = [];
        foreach ($tranpose7 as $key => $value) {
            foreach ($value as $k => $v) {
                $normalisasi7[$key][$k] = $v / $sqrt7[$key];
            }
        }
        foreach ($tranpose8 as $key => $value) {
            foreach ($value as $k => $v) {
                $normalisasi8[$key][$k] = $v / $sqrt8[$key];
            }
        }
        foreach ($tranpose9 as $key => $value) {
            foreach ($value as $k => $v) {
                $normalisasi9[$key][$k] = $v / $sqrt9[$key];
            }
        }

        $normalisasi17 = call_user_func_array('array_map', array_merge(array(NULL), $normalisasi7));
        $normalisasi18 = call_user_func_array('array_map', array_merge(array(NULL), $normalisasi8));
        $normalisasi19 = call_user_func_array('array_map', array_merge(array(NULL), $normalisasi9));
        $data['normalisasi7'] = $normalisasi17;
        $data['normalisasi8'] = $normalisasi18;
        $data['normalisasi9'] = $normalisasi19;

        $kriteria = [];
        foreach ($this->Kriteria->getKriteria() as $key => $value) {
            $kriteria[$value['id_kriteria']] = $value;
        }

        $ternormalisasi7 = [];
        $ternormalisasi8 = [];
        $ternormalisasi9 = [];
        foreach ($normalisasi7 as $key => $value) {
            foreach ($value as $k => $v) {
                $ternormalisasi7[$k][$key] = $v * $kriteria[$key]['bobot_nilai'];
            }
        }
        foreach ($normalisasi8 as $key => $value) {
            foreach ($value as $k => $v) {
                $ternormalisasi8[$k][$key] = $v * $kriteria[$key]['bobot_nilai'];
            }
        }
        foreach ($normalisasi9 as $key => $value) {
            foreach ($value as $k => $v) {
                $ternormalisasi9[$k][$key] = $v * $kriteria[$key]['bobot_nilai'];
            }
        }
        $data['ternormalisasi7'] = $ternormalisasi7;
        $data['ternormalisasi8'] = $ternormalisasi8;
        $data['ternormalisasi9'] = $ternormalisasi9;

        $max7 = [];
        $min7 = [];
        $tabel_yi7 = [];

        $max8 = [];
        $min8 = [];
        $tabel_yi8 = [];

        $max9 = [];
        $min9 = [];
        $tabel_yi9 = [];
        foreach ($ternormalisasi7 as $key => $value) {
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
            $max7[$key] = $res;
            $min7[$key] = $res2;
            $tabel_yi7[$key] = $res - $res2;
        }
        foreach ($ternormalisasi8 as $key => $value) {
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
            $max8[$key] = $res;
            $min8[$key] = $res2;
            $tabel_yi8[$key] = $res - $res2;
        }
        foreach ($ternormalisasi9 as $key => $value) {
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
            $max9[$key] = $res;
            $min9[$key] = $res2;
            $tabel_yi9[$key] = $res - $res2;
        }
        $data['max7'] = $max7;
        $data['min7'] = $min7;
        $data['tabel_yi7'] = $tabel_yi7;
        $data['max8'] = $max8;
        $data['min8'] = $min8;
        $data['tabel_yi8'] = $tabel_yi8;
        $data['max9'] = $max9;
        $data['min9'] = $min9;
        $data['tabel_yi9'] = $tabel_yi9;

        $rankings7 = array_unique($tabel_yi7);
        rsort($rankings7);

        $rankings8 = array_unique($tabel_yi8);
        rsort($rankings8);

        $rankings9 = array_unique($tabel_yi9);
        rsort($rankings9);

        // dd($rankings);

        $result_data7 = [];
        $result_data8 = [];
        $result_data9 = [];
        $i = 1;
        foreach ($rankings7 as $key => $value) {
            $result_data7["" . $value] = $i;
            $i++;
        }
        $i = 1;
        foreach ($rankings8 as $key => $value) {
            $result_data8["" . $value] = $i;
            $i++;
        }
        $i = 1;
        foreach ($rankings9 as $key => $value) {
            $result_data9["" . $value] = $i;
            $i++;
        }

        $text_rank7 = [];
        $text_rank8 = [];
        $text_rank9 = [];
        foreach ($tabel_yi7 as $key => $value) {
            $rank = $result_data7["" . $value];
            $siswa[$key]['value7'] = $value;
            $siswa[$key]['rank7'] = $rank;
            $text_rank7[] = $siswa[$key];
        }
        foreach ($tabel_yi8 as $key => $value) {
            $rank = $result_data8["" . $value];
            $siswa[$key]['value8'] = $value;
            $siswa[$key]['rank8'] = $rank;
            $text_rank8[] = $siswa[$key];
        }
        foreach ($tabel_yi9 as $key => $value) {
            $rank = $result_data9["" . $value];
            $siswa[$key]['value9'] = $value;
            $siswa[$key]['rank9'] = $rank;
            $text_rank9[] = $siswa[$key];
        }

        $data['sorted_rank_data7'] = $text_rank7;
        $data['sorted_rank_data8'] = $text_rank8;
        $data['sorted_rank_data9'] = $text_rank9;

        $role = session('role');
        $data['role'] = $role;
        if ($role == 1) {
            return view('admin/peringkat/rank', $data,);
        }
        if ($role == 2) {
            return view('guru/peringkat/rank', $data,);
        }
        if ($role == 3) {
            return view('siswa/peringkat/rank', $data,);
        }
    }
}
