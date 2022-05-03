<?php

namespace App\Models;

use CodeIgniter\Model;

class SessionModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'session';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id','debutSession','finSession','creche_id','date_debut','date_fin'];

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

    public function call_all_session(){
        return $this->select('*')
            ->join('professionnels','creche_id = professionnels.id')
            ->findAll();
    }

    public function call_all_session_where_debut($debut){
        return $this->select('*')
            ->where('date_debut <=' , $debut)
            ->where('date_fin >=' , $debut)

            ->findAll();
    }
    public function call_all_session_where_fin($fin){
        return $this->select('*')
            ->where('date_fin >=' , $fin)
            ->where('date_debut <=' , $fin)
            ->findAll();
    }
    public function call_all_session_where_both($debut, $fin){
        return $this->select('*')
            ->where('date_debut <=' , $debut)
            ->where('date_fin >=' , $fin)
            ->findAll();
    }
}
