<?php

namespace App\Models;

use CodeIgniter\Model;

class logementModel extends Model
{
    protected $table            = 'logement';
    protected $primaryKey       = 'id';

    protected bool $allowEmptyInserts = true;

    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = ['details'];

    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
}