<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservationSplitModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'reservationsplit';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nom_reservation','debut_reservation','fin_reservation','debut_date_reservation','fin_date_reservation'];

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

    public function test()
    {
        $this->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");

        return $this->select("*")
            ->join('reservation', 'reservationsplit.nom_reservation = reservation.id_reservation')
            ->join('enfants', 'reservation.id_enfant = enfants.id')
            ->join('creneau', 'reservation.id_creneau = creneau.id')
            ->join('professionnels', 'creneau.creche_id = professionnels.id')
            ->groupBy("reservation.id_reservation")
            ->findAll();
    }

}
