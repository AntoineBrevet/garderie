<?php

namespace App\Models;

use CodeIgniter\Model;

class MessagesModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'messages';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_auteur', 'id_destinataire', 'contenu', 'statut'];

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

    public function displayMessages($id)
    {
        $where = "(messages.id_auteur=" . session('id') . " AND messages.id_destinataire=" . $id . " AND messages.statut ='parent') OR ( messages.id_destinataire=" . session('id') . " AND messages.id_auteur =" . $id . " AND messages.statut = 'pro')";

        return $this->select("*")
            ->where($where)
            ->findAll();
    }

    public function displayAllMessages()
    {

        $where = "(messages.id_auteur=" . session('id') . " AND messages.statut ='parent') OR ( messages.id_destinataire=" . session('id') . " AND messages.statut = 'pro')";

        return $this->select("*")
            ->where($where)
            ->findAll();
    }

    public function displayContact()
    {
        $this->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");

        $where = "messages.id_destinataire=" . session('id') . " AND messages.statut ='parent'";

        return $this->select("*")
            ->join('parents', 'parents.id = messages.id_auteur')
            ->where($where)
            ->groupBy("messages.id_auteur")
            ->findAll();
    }

    public function displayContactUser()
    {
        $this->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");

        $where = "messages.id_auteur=" . session('id') . " AND messages.statut ='parent'";
        return $this->select("*")
            ->join('professionnels', 'professionnels.id = messages.id_destinataire')
            ->where($where)
            ->groupBy("messages.id_destinataire")
            ->findAll();
    }
}
