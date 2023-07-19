<?php

namespace App\Models;

use CodeIgniter\Model;

class KriteriaModel extends Model

{
   protected $DBGroup          = 'default';
   protected $table            = 'kriteria';
   protected $primaryKey       = 'id_kriteria';
   protected $useAutoIncrement = true;
   protected $insertID         = 0;
   protected $returnType       = 'array';
   protected $useSoftDeletes   = false;
   protected $protectFields    = true;
   protected $allowedFields    = ['nama_kriteria', 'kode_kriteria', 'jenis_nilai', 'bobot_nilai'];

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

   public function getKriteria()
   {
      $query = $this->db->query("SELECT * FROM kriteria");
      return $query->getResultArray();
   }


   public function getAllNilaiKriteria()
   {
      return $this->db->query("SELECT * FROM nilai_kriteria ")->result_array();
   }

   public function getAllKriteria()
   {

      $query = $this->db->query("SELECT * FROM kriteria ");
      $results = $query->getResultArray();
      return $results;
   }

   public function getKriteriaByID($id_kriteria)
   {
      $query = $this->db->query("SELECT * FROM kriteria WHERE `id_kriteria` = '$id_kriteria'");
      $results = $query->getRowArray();
      return $results;
   }

   public function getKriteriaByNmKriteria($kriteria)
   {
      $query = $this->db->query(
         "SELECT * 
         FROM kriteria 
         WHERE nama_kriteria = $kriteria"
      );
      $results = $query->getRowArray();
      return $results;
   }

   public function editKriteriaData($new_data = array())
   {
      $nama_kriteria = $new_data['nama_kriteria'];
      $kode_kriteria = $new_data['kode_kriteria'];
      $jenis_nilai = $new_data['jenis_nilai'];
      $id_kriteria = $new_data['id_kriteria'];

      $query = "UPDATE kriteria SET `nama_kriteria` = '$nama_kriteria', `kode_kriteria` = '$kode_kriteria', `jenis_nilai` = '$jenis_nilai' WHERE `id_kriteria` = '$id_kriteria'";
      return $this->db->query($query);
   }
}
