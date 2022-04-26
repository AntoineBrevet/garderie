<?php

namespace App\Models;

use CodeIgniter\Model;

class CreneauModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'creneau';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['date', 'debut', 'fin', 'creche_id', 'nbr_place', 'nbr_place_restant'];

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

    public function call_creneau_by_pro($idpro)
    {
        return $this->select("*")
            ->join('professionnels', 'creneau.creche_id = professionnels.id')
            ->where(['professionnels.id' => $idpro])
            ->findAll();
    }
}
