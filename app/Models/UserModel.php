<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'user';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['username', 'password', 'role'];

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


    public function getAllUser()
    {
        $query = $this->db->query("SELECT * FROM user ");
        $results = $query->getResultArray();
        return $results;
    }

    public function getUserByID($user_id)
    {
        $query = $this->db->query("SELECT * FROM user WHERE id = '$user_id'");
        $results = $query->getRowArray();
        return $results;
    }

    public function getUserByUsername($username)
    {
        $query = $this->db->query("SELECT * FROM user WHERE username = '$username'");
        $results = $query->getRowArray();
        return $results;
    }

    public function getUserByRole($role)
    {
        $query = $this->db->query("SELECT * FROM user WHERE role = '$role'");
        $results = $query->getRowArray();
        return $results;
    }
}
