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

        if (!empty($this->Nilai->getAllNilaiSiswa())) {
            //rumus 1
            $tranpose = [];

            foreach ($this->Nilai->getNilaiSiswaByKelas($id_kelas) as $key => $value) {

                $tranpose[$value['fk_id_kriteria']][$value['fk_id_siswa']] = $value['nilai'];
                // dd($tranpose[$key]);
            }
            // dd($tranpose);

            //rumus 2
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

            //rumus 2
            $normalisasi = [];
            foreach ($tranpose as $key => $value) {
                foreach ($value as $k => $v) {
                    $normalisasi[$key][$k] = $v / $sqrt[$key];
                }
            }

            //for view only
            $normalisasi1 = call_user_func_array('array_map', array_merge(array(NULL), $normalisasi));
            $data['normalisasi'] = $normalisasi1;

            // dd($normalisasi1);

            $kriteria = [];
            foreach ($this->Kriteria->getKriteria() as $key => $value) {
                $kriteria[$value['id_kriteria']] = $value;
            }

            //rumus 3
            $ternormalisasi = [];
            foreach ($normalisasi as $key => $value) {
                foreach ($value as $k => $v) {
                    $ternormalisasi[$k][$key] = $v * $kriteria[$key]['bobot_nilai'];
                }
            }
            $data['ternormalisasi'] = $ternormalisasi;

            // dd($ternormalisasi);

            //rumus 3, pengurangan max & min
            $max = [];
            $min = [];
            $tabel_yi = [];
            foreach ($ternormalisasi as $key => $value) {
                $res = 0; //max value
                $res2 = 0; //min value
                foreach ($value as $a => $b) {
                    if ($kriteria[$a]['jenis_nilai'] == 1) {

                        $res += $b;
                    }
                    // else {
                    //     $res -= 0;
                    // }
                    if ($kriteria[$a]['jenis_nilai'] == 0) {

                        $res2 += $b;
                    }
                    // else {
                    //     $res2 -= 0;
                    // }
                }
                $max[$key] = $res;
                $min[$key] = $res2;
                $tabel_yi[$key] = $res - $res2;
            }
            $data['max'] = $max;
            $data['min'] = $min;
            $data['tabel_yi'] = $tabel_yi;
            // dd($tabel_yi);

            $rankings = $tabel_yi;
            rsort($rankings);

            // dd($rankings);


            // buat ranking
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



        }
        $role = session('role');
        $data['role'] = $role;

        if ($id_kelas == 7) {
            return view('admin/siswa/kelas 7/hitung', $data,);
        } elseif ($id_kelas == 8) {
            return view('admin/siswa/kelas 8/hitung', $data,);
        } elseif ($id_kelas == 9) {
            return view('admin/siswa/kelas 9/hitung', $data,);
        }
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

        if (!empty($this->Nilai->getNilaiSiswaByKelas(7))) {
            $tranpose7 = [];

            foreach ($this->Nilai->getNilaiSiswaByKelas(7) as $key => $value) {

                $tranpose7[$value['fk_id_kriteria']][$value['fk_id_siswa']] = $value['nilai'];
                // dd($tranpose[$key]);
            }
            // dd($tranpose);

            //rumus 2
            $sqrt7   = [];
            foreach ($tranpose7 as $key => $value) {
                $sum = 0;

                foreach ($value as $k => $val) {
                    $sum += pow($val, 2);
                }

                $sqrt7[$key] = sqrt($sum);
            }

            $data['sqrt7'] = $sqrt7;

            // dd($sqrt);

            //rumus 2
            $normalisasi7 = [];
            foreach ($tranpose7 as $key => $value) {
                foreach ($value as $k => $v) {
                    $normalisasi7[$key][$k] = $v / $sqrt7[$key];
                }
            }

            //for view only
            $normalisasi17 = call_user_func_array('array_map', array_merge(array(NULL), $normalisasi7));
            $data['normalisasi7'] = $normalisasi17;

            // dd($normalisasi1);

            $kriteria7 = [];
            foreach ($this->Kriteria->getKriteria() as $key => $value) {
                $kriteria7[$value['id_kriteria']] = $value;
            }

            //rumus 3
            $ternormalisasi7 = [];
            foreach ($normalisasi7 as $key => $value) {
                foreach ($value as $k => $v) {
                    $ternormalisasi7[$k][$key] = $v * $kriteria7[$key]['bobot_nilai'];
                }
            }
            $data['ternormalisasi7'] = $ternormalisasi7;

            // dd($ternormalisasi);

            //rumus 3, pengurangan max & min
            $max7 = [];
            $min7 = [];
            $tabel_yi7 = [];
            foreach ($ternormalisasi7 as $key => $value) {
                $res = 0; //max value
                $res2 = 0; //min value
                foreach ($value as $a => $b) {
                    if ($kriteria7[$a]['jenis_nilai'] == 1) {

                        $res += $b;
                    }
                    // else {
                    //     $res -= 0;
                    // }
                    if ($kriteria7[$a]['jenis_nilai'] == 0) {

                        $res2 += $b;
                    }
                    // else {
                    //     $res2 -= 0;
                    // }
                }
                $max7[$key] = $res;
                $min7[$key] = $res2;
                $tabel_yi7[$key] = $res - $res2;
            }
            $data['max7'] = $max7;
            $data['min7'] = $min7;
            $data['tabel_yi7'] = $tabel_yi7;
            // dd($tabel_yi);

            $rankings7 = $tabel_yi7;
            rsort($rankings7);

            // dd($rankings);


            // buat ranking
            $result_data7 = [];
            $i = 1;
            foreach ($rankings7 as $key => $value) {
                $result_data7["" . $value] = $i;
                $i++;
            }
            // dd($result_data);


            $text_rank7 = [];
            foreach ($tabel_yi7 as $key => $value) {
                $rank = $result_data7["" . $value];
                $siswa[$key]['value7'] = $value;
                $siswa[$key]['rank7'] = $rank;
                // $siswa[$key]['altt'] = $alternatif;
                $text_rank7[] = $siswa[$key];
            }
            // dd($text_rank);


            $data['sorted_rank_data7'] = $text_rank7;

            // dd($text_rank);
        }

        if (!empty($this->Nilai->getNilaiSiswaByKelas(8))) {
            $tranpose8 = [];

            foreach ($this->Nilai->getNilaiSiswaByKelas(8) as $key => $value) {

                $tranpose8[$value['fk_id_kriteria']][$value['fk_id_siswa']] = $value['nilai'];
                // dd($tranpose[$key]);
            }
            // dd($tranpose);

            //rumus 2
            $sqrt8   = [];
            foreach ($tranpose8 as $key => $value) {
                $sum = 0;

                foreach ($value as $k => $val) {
                    $sum += pow($val, 2);
                }

                $sqrt8[$key] = sqrt($sum);
            }

            $data['sqrt8'] = $sqrt8;

            // dd($sqrt);

            //rumus 2
            $normalisasi8 = [];
            foreach ($tranpose8 as $key => $value) {
                foreach ($value as $k => $v) {
                    $normalisasi8[$key][$k] = $v / $sqrt8[$key];
                }
            }

            //for view only
            $normalisasi18 = call_user_func_array('array_map', array_merge(array(NULL), $normalisasi8));
            $data['normalisasi8'] = $normalisasi18;

            // dd($normalisasi1);

            $kriteria8 = [];
            foreach ($this->Kriteria->getKriteria() as $key => $value) {
                $kriteria8[$value['id_kriteria']] = $value;
            }

            //rumus 3
            $ternormalisasi8 = [];
            foreach ($normalisasi8 as $key => $value) {
                foreach ($value as $k => $v) {
                    $ternormalisasi8[$k][$key] = $v * $kriteria8[$key]['bobot_nilai'];
                }
            }
            $data['ternormalisasi8'] = $ternormalisasi8;

            // dd($ternormalisasi);

            //rumus 3, pengurangan max & min
            $max8 = [];
            $min8 = [];
            $tabel_yi8 = [];
            foreach ($ternormalisasi8 as $key => $value) {
                $res = 0; //max value
                $res2 = 0; //min value
                foreach ($value as $a => $b) {
                    if ($kriteria8[$a]['jenis_nilai'] == 1) {

                        $res += $b;
                    }
                    // else {
                    //     $res -= 0;
                    // }
                    if ($kriteria8[$a]['jenis_nilai'] == 0) {

                        $res2 += $b;
                    }
                    // else {
                    //     $res2 -= 0;
                    // }
                }
                $max8[$key] = $res;
                $min8[$key] = $res2;
                $tabel_yi8[$key] = $res - $res2;
            }
            $data['max8'] = $max8;
            $data['min8'] = $min8;
            $data['tabel_yi8'] = $tabel_yi8;
            // dd($tabel_yi);

            $rankings8 = $tabel_yi8;
            rsort($rankings8);

            // dd($rankings);


            // buat ranking
            $result_data8 = [];
            $i = 1;
            foreach ($rankings8 as $key => $value) {
                $result_data8["" . $value] = $i;
                $i++;
            }
            // dd($result_data);


            $text_rank8 = [];
            foreach ($tabel_yi8 as $key => $value) {
                $rank = $result_data8["" . $value];
                $siswa[$key]['value8'] = $value;
                $siswa[$key]['rank8'] = $rank;
                // $siswa[$key]['altt'] = $alternatif;
                $text_rank8[] = $siswa[$key];
            }
            // dd($text_rank);


            $data['sorted_rank_data8'] = $text_rank8;

            // dd($text_rank);
        }

        if (!empty($this->Nilai->getNilaiSiswaByKelas(9))) {
            $tranpose9 = [];

            foreach ($this->Nilai->getNilaiSiswaByKelas(9) as $key => $value) {

                $tranpose9[$value['fk_id_kriteria']][$value['fk_id_siswa']] = $value['nilai'];
                // dd($tranpose[$key]);
            }
            // dd($tranpose);

            //rumus 2
            $sqrt9   = [];
            foreach ($tranpose9 as $key => $value) {
                $sum = 0;

                foreach ($value as $k => $val) {
                    $sum += pow($val, 2);
                }

                $sqrt9[$key] = sqrt($sum);
            }

            $data['sqrt9'] = $sqrt9;

            // dd($sqrt);

            //rumus 2
            $normalisasi9 = [];
            foreach ($tranpose9 as $key => $value) {
                foreach ($value as $k => $v) {
                    $normalisasi9[$key][$k] = $v / $sqrt9[$key];
                }
            }

            //for view only
            $normalisasi19 = call_user_func_array('array_map', array_merge(array(NULL), $normalisasi9));
            $data['normalisasi9'] = $normalisasi19;

            // dd($normalisasi1);

            $kriteria9 = [];
            foreach ($this->Kriteria->getKriteria() as $key => $value) {
                $kriteria9[$value['id_kriteria']] = $value;
            }

            //rumus 3
            $ternormalisasi9 = [];
            foreach ($normalisasi9 as $key => $value) {
                foreach ($value as $k => $v) {
                    $ternormalisasi9[$k][$key] = $v * $kriteria9[$key]['bobot_nilai'];
                }
            }
            $data['ternormalisasi9'] = $ternormalisasi9;

            // dd($ternormalisasi);

            //rumus 3, pengurangan max & min
            $max9 = [];
            $min9 = [];
            $tabel_yi9 = [];
            foreach ($ternormalisasi9 as $key => $value) {
                $res = 0; //max value
                $res2 = 0; //min value
                foreach ($value as $a => $b) {
                    if ($kriteria9[$a]['jenis_nilai'] == 1) {

                        $res += $b;
                    }
                    // else {
                    //     $res -= 0;
                    // }
                    if ($kriteria9[$a]['jenis_nilai'] == 0) {

                        $res2 += $b;
                    }
                    // else {
                    //     $res2 -= 0;
                    // }
                }
                $max9[$key] = $res;
                $min9[$key] = $res2;
                $tabel_yi9[$key] = $res - $res2;
            }
            $data['max9'] = $max9;
            $data['min9'] = $min9;
            $data['tabel_yi9'] = $tabel_yi9;
            // dd($tabel_yi);

            $rankings9 = $tabel_yi9;
            rsort($rankings9);

            // dd($rankings);


            // buat ranking
            $result_data9 = [];
            $i = 1;
            foreach ($rankings9 as $key => $value) {
                $result_data9["" . $value] = $i;
                $i++;
            }
            // dd($result_data);


            $text_rank9 = [];
            foreach ($tabel_yi9 as $key => $value) {
                $rank = $result_data9["" . $value];
                $siswa[$key]['value9'] = $value;
                $siswa[$key]['rank9'] = $rank;
                // $siswa[$key]['altt'] = $alternatif;
                $text_rank9[] = $siswa[$key];
            }
            // dd($text_rank);


            $data['sorted_rank_data9'] = $text_rank9;

            // dd($text_rank);
        }








        $role = session('role');
        $data['role'] = $role;

        return view('admin/peringkat/rank', $data,);
    }
}
