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
   protected $allowedFields    = ['nama_siswa', 'nis', 'kelas', 'jenis_kelamin', 'alamat', 'no_telepon'];

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

   public function getSiswa($id = false)
   {
      if ($id === false) {
         return $this->table('siswa')
            ->get()
            ->getResultArray();
      } else {
         return $this->table('siswa')
            ->where('id', $id)
            ->get()
            ->getRowArray();
      }
   }


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
      return $this->db->query("SELECT * FROM siswa WHERE `nama_siswa` = '$nama_siswa'")->row_array();
   }

   public function getAllSiswaByStatus($status)
   {
      return $this->db->query("SELECT * FROM siswa WHERE `status_nilai` = '$status'")->result_array();
   }

   public function countSiswa()
   {
      return $this->db->count_all('siswa');
   }

   public function changeStatus($id_siswa, $status)
   {
      return $this->db->query("UPDATE siswa SET `status_nilai` = '$status' WHERE `id_siswa` = '$id_siswa'");
   }
}
