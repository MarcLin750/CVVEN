<?php

namespace App\Models;

use CodeIgniter\Model;

class LogementModel extends Model
{
    protected $table            = 'logement';
    protected $primaryKey       = 'id';

    protected bool $allowEmptyInserts = true;

    protected $returnType       = 'array';
    // protected $useSoftDeletes   = true;

    protected $allowedFields    = ['numLogement', 'etage', 'aile', 'ville', 'categorie', 'details', 'nbrChambre', 'nbrLit', 'balcon']; // modifiée champs si besoin

    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
    
    public function countCategory1() { return $this->db->table('logement')->where('categorie', 1)->countAllResults(); }
    public function countCategory2() { return $this->db->table('logement')->where('categorie', 2)->countAllResults(); }
    public function countCategory3() { return $this->db->table('logement')->where('categorie', 3)->countAllResults(); }
    public function countCategory4() { return $this->db->table('logement')->where('categorie', 4)->countAllResults(); }
    public function countCategory5() { return $this->db->table('logement')->where('categorie', 5)->countAllResults(); }
}