<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiSiswaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'nilai_siswa';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_kriteria','id_siswa','role'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    // public function insert($data = array())
    // {
    //    return $this->db->insert('nilai_siswa', $data);
    // }
 
    public function getAllNilaiSiswa()
    {
       return $this->db->query("SELECT * FROM siswa INNER JOIN nilai_siswa ON siswa.id_siswa=nilai_siswa.id_siswa")->result_array();
    }
 
    public function getNilaiSiswaByIdSiswa($id_siswa)
    {
       return $this->db->query("SELECT * FROM nilai_siswa INNER JOIN kriteria ON nilai_siswa.id_kriteria=kriteria.id_kriteria WHERE `id_siswa` = '$id_siswa'")->result_array();
    }
 
    public function getNilaiSiswaByNmSiswa($nama_siswa)
    {
       return $this->db->query("SELECT * FROM siswa WHERE `nama_siswa` = '$nama_siswa'")->row_array();
    }
 
    public function getNilaiSiswaByIDKriteria($id_kriteria)
    {
       return $this->db->query("SELECT nilai_siswa.id, nilai_siswa.id_siswa, nilai_siswa.id_kriteria, nilai_siswa.nilai, kriteria.jenis_nilai  FROM nilai_siswa INNER JOIN kriteria ON nilai_siswa.id_kriteria=kriteria.id_kriteria WHERE nilai_siswa.id_kriteria = '$id_kriteria'")->result_array();
    }
 
    public function countNilaiSiswa()
    {
       return $this->db->count_all('nilai_siswa');
    }
 
    public function editNilaiSiswaData($new_data = array())
    {
       $nilai = $new_data['nilai'];
       $id_kriteria = $new_data['id_kriteria'];
       $id_siswa = $new_data['id_siswa'];
 
       $query = "UPDATE nilai_siswa SET `nilai` = '$nilai' WHERE `id_siswa` = '$id_siswa' AND `id_kriteria` = '$id_kriteria'";
       return $this->db->query($query);
    }
 
    public function deleteNilaiSiswa($id_siswa)
    {
       $query = "DELETE FROM nilai_siswa WHERE `id_siswa` = '$id_siswa'";
       return $this->db->query($query);
    }
 
    public function updatePassword($username, $password)
    {
       return $this->db->query("UPDATE user SET `password` = '$password' WHERE `username` = '$username'");
    }

}
