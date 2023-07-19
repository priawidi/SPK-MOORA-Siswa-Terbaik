<?php

namespace App\Models;

use CodeIgniter\Model;

class MetodeModel extends Model
{


    public function getAllNilai()
    {
        $query = $this->db->query(
            "SELECT *
            FROM nilai_siswa
            ORDER BY id_nilai"
        );
        return $query->getResult();
    }

    public function getAlternatifById()
    {
        $query = $this->db->query("SELECT * FROM siswa ORDER BY id_siswa ASC");

        return $query->getResult();
    }

    public function getKriteriaById()
    {
        $query = $this->db->query("SELECT * FROM kriteria ORDER BY id_kriteria ASC");

        return $query->getResult();
    }

    public function getNilaiSetiapAlternatifById($id_siswa, $id_kriteria)
    {
        $query = $this->db->query(
            "SELECT *
            FROM nilai_siswa
            WHERE fk_id_siswa = $id_siswa
            AND fk_id_kriteria = $id_kriteria"
        );
        return $query->getResult();
    }

    public function getDataPenilaian($id_siswa, $id_kriteria)
    {
        $query = $this->db->query(
            "SELECT *
            FROM nilai_siswa
            WHERE fk_id_siswa = $id_siswa
            AND fk_id_kriteria = $id_kriteria"
        );
        return $query->getRowArray();
    }

    public function getNilaiSetiapAlternatif()
    {
        $query = $this->db->query(
            "SELECT DISTINCT siswa.nama_siswa, siswa.id_siswa 
            FROM siswa
            JOIN nilai_siswa ON siswa.id_siswa = nilai_siswa.fk_id_siswa"
        );
        return $query->getResult();
    }

    public function normalisasiNilai($id_kriteria)
    {
        $query = $this->db->query(
            "SELECT SQRT(SUM(POWER(nilai, 2)))
            AS nilai_pembagian
            FROM nilai_siswa
            WHERE fk_id_kriteria = $id_kriteria"
        );
        return $query->getRowArray();
    }

    public function pembobotanNilai($id_kriteria)
    {
        $query = $this->db->query(
            "SELECT ((nilai / nilai_pembagian) * kriteria.bobot)
            AS pembobotan_setiap_nilai, kriteria.bobot, kriteria.jenis_nilai
            JOIN kriteria ON kriteria.id_kriteria = nilai_siswa.fk_id_siswa
            WHERE kriteria.id_kriteria = $id_kriteria
            GROUP BY nilai_siswa.fk_id_siswa"
        );
        return $query->getRowArray();
    }

    public function hasilNilai($id_siswa)
    {
        $query = $this->db->query(
            "SELECT * 
            FROM siswa
            WHERE id_siswa=$id_siswa"
        );
        return $query->getRowArray();
    }
}
