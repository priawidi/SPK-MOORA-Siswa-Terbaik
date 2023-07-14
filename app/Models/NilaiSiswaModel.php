<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiSiswaModel extends Model
{
   protected $DBGroup          = 'default';
   protected $table            = 'nilai_siswa';
   protected $primaryKey       = 'id_nilai';
   protected $useAutoIncrement = true;
   protected $insertID         = 0;
   protected $returnType       = 'array';
   protected $useSoftDeletes   = false;
   protected $protectFields    = true;
   protected $allowedFields    = ['fk_id_kriteria', 'fk_id_siswa', 'nilai'];

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
      $query = $this->db->query("SELECT * 
      FROM siswa 
      JOIN nilai_siswa ON  siswa.id_siswa = nilai_siswa.fk_id_siswa 
      JOIN kriteria ON  kriteria.id_kriteria = nilai_siswa.fk_id_kriteria");
      $results = $query->getResultArray();
      return $results;
   }

   public function getNilaiSiswaByIdSiswa($id_siswa)
   {
      $query = $this->db->query("SELECT * 
      FROM nilai_siswa 
      JOIN kriteria 
      ON nilai_siswa.fk_id_kriteria = kriteria.id_kriteria
      WHERE nilai_siswa.fk_id_siswa = $id_siswa");
      $results = $query->getResultArray();
      return $results;

      // $query = $this->db->query("SELECT * 
      // FROM siswa 
      // JOIN nilai_siswa ON  siswa.id_siswa = nilai_siswa.fk_id_siswa 
      // WHERE id_siswa = $id_siswa");
      // $results = $query->getResultArray();
      // return $results;
   }
   public function getDetailNilai($id_siswa)
   {
      $query = $this->db->query("SELECT nilai_siswa.nilai, siswa.nama_siswa, kriteria.nama_kriteria, nilai_siswa.fk_id_siswa, nilai_siswa.fk_id_kriteria, nilai_siswa.id_nilai
      FROM nilai_siswa
      JOIN siswa ON siswa.id_siswa = nilai_siswa.fk_id_siswa
      JOIN kriteria ON  kriteria.id_kriteria = nilai_siswa.fk_id_kriteria
      WHERE nilai_siswa.fk_id_siswa = $id_siswa");
      $results = $query->getResultArray();
      return $results;
   }

   public function getDetailNilaibyKriteria($id_kriteria)
   {
      $query = $this->db->query("SELECT nilai_siswa.nilai, siswa.nama_siswa, kriteria.nama_kriteria, nilai_siswa.fk_id_siswa, nilai_siswa.fk_id_kriteria, nilai_siswa.id_nilai
      FROM nilai_siswa
      JOIN siswa ON siswa.id_siswa = nilai_siswa.fk_id_siswa
      JOIN kriteria ON  kriteria.id_kriteria = nilai_siswa.fk_id_kriteria
      WHERE nilai_siswa.fk_id_kriteria = $id_kriteria");
      $results = $query->getRowArray();
      return $results;
   }

   public function getNilaiSiswaByNmSiswa($nama_siswa)
   {
      return $this->db->query("SELECT * FROM siswa WHERE `nama_siswa` = '$nama_siswa'")->row_array();
   }

   public function getNilaiSiswaByIDKriteria($id_kriteria)
   {
      return $this->db->query(
         "SELECT nilai_siswa.id, nilai_siswa.id_siswa, nilai_siswa.id_kriteria, nilai_siswa.nilai, kriteria.jenis_nilai  
         FROM nilai_siswa 
         INNER JOIN kriteria ON nilai_siswa.id_kriteria=kriteria.id_kriteria 
         WHERE nilai_siswa.id_kriteria = '$id_kriteria'"
      )->result_array();
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
