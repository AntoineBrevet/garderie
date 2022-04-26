<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservationModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'reservation';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_enfants','id_creneau'];

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

    public function call_reservation_infos() {
        return $this->select("*")
            ->join('creneau', 'reservation.id_creneau = creneau.id')
            ->join('professionnels', 'creneau.creche_id = professionnels.id')
            ->join('enfants', 'reservation.id_enfant = enfants.id')
            ->join('recupere', 'enfants.id = recupere.id_enfant')
            ->join('parents', 'enfants.parents_id = parents.id')
            ->where(['professionnels.id' => ' '])
            ->findAll();
    }
}
