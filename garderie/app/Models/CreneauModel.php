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
    protected $allowedFields    = ['debut', 'fin', 'creche_id', 'nbr_place', 'nbr_place_restant', 'jour', 'session_id', 'date'];

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
    public function show_sessions()
    {
        $this->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");

        return $this->select("*")
            ->join('session', 'creneau.session_id = session.id')
            ->where(['creneau.creche_id' => session('id')])
            ->groupBy('session.id')
            ->findAll();
    }

    public function call_creneau_by_places($nbr)
    {
        return $this->select("*")
            ->where(['nbr_place_restant >' => $nbr])
            ->findAll();
    }

    public function call_all_creneau()
    {
        return $this->select("*")
            ->findAll();
    }

    public function call_creneau_infos_by_id($id)
    {
        return $this->select("*")
            ->where(['id' => $id])
            ->findAll();
    }

    public function call_creneau_infos_by_idSession($idSession)
    {
        return $this->select("*")
            ->where(['session_id' => $idSession])
            ->findAll();
    }
    public function call_creneau_infos_by_idSession2($idSession)
    {
        return $this->select("*")
            ->join('session', 'creneau.session_id = session.id')
            ->where(['session_id' => $idSession])
            ->findAll();
    }
}
