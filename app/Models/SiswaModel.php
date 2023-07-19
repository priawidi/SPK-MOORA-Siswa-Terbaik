<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
   protected $DBGroup          = 'default';
   protected $table            = 'siswa';
   protected $primaryKey       = 'id_siswa';
   protected $useAutoIncrement = true;
   protected $insertID         = 0;
   protected $returnType       = 'array';
   protected $useSoftDeletes   = false;
   protected $protectFields    = true;
   protected $allowedFields    = ['nama_siswa', 'nis', 'kelas'];

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

   public function getAllSiswa()
   {
      $query = $this->db->query("SELECT * FROM siswa ");
      $results = $query->getResultArray();
      return $results;
   }

   public function getSiswaByID($id_siswa)
   {
      $query =  $this->db->query("SELECT * FROM siswa WHERE `id_siswa` = '$id_siswa'");
      $results = $query->getRowArray();
      return $results;
   }

   public function getSiswaByNmSiswa($nama_siswa)
   {
      $query = $this->db->query("SELECT * 
         FROM siswa 
         JOIN nilai_siswa ON  nilai_siswa.fk_id_siswa = siswa.id_siswa
         JOIN kriteria ON  kriteria.id_kriteria = nilai_siswa.fk_id_kriteria
         WHERE siswa.nama_siswa = $nama_siswa");
      $results = $query->getRowArray();
      return $results;
   }

   public function getAllSiswaByStatus($status)
   {
      return $this->db->query("SELECT * FROM siswa WHERE `status_nilai` = '$status'")->result_array();
   }
}
