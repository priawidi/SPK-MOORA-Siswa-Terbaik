<?php

namespace App\Models;

use CodeIgniter\Model;

class BobotAlternatifModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bobot_alternatif';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_kriteria','id_siswa','nilai_bobot'];

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


//     public function insert($data = array())
//    {
//       return $this->db->insert('bobot_alternatif', $data);
//    }

   public function getAlternatifByID($id_siswa)
   {
      return $this->db->query("SELECT * FROM bobot_alternatif WHERE `id_siswa` = '$id_siswa'")->result_array();
   }

   public function truncate_alternatif()
   {
      return $this->db->query("TRUNCATE TABLE bobot_alternatif");
   }
}
