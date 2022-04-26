<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfessionnelsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'professionnels';
    protected $primaryKey       = 'idPros';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nomPros', 'prenomPros', 'adressePros', 'siret', 'telPros', 'descriptionPros', 'mdpPros', 'mailPros'];

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

    public function findByEmail(string $mail)
    {
        return $this->where(['mailPros' => $mail])->first();
    }

    public function call_pro_infos()
    {
        return $this->select("*")
            ->join('creneau', 'creneau.creche_id = professionnels.id')
            ->findAll();
    }
}
