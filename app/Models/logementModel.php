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
    protected $allowedFields    = [
        'numLogement',
        'etage',
        'aile',
        'ville',
        'categorie',
        'details',
        'nbrChambre',
        'nbrLit',
        'prix',
        'devise',
        'balcon',
        'reserver'
    ]; 
    protected $useTimestamps = false;
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $allowCallbacks = true;

    public function getLogementById($id)
    {
        // Utilisez la méthode find() pour récupérer le logement par son identifiant.
        return $this->find($id);
    }
}
