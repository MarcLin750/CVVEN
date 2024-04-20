<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservationModel extends Model
{
    protected $table = 'reservation';
    protected $primaryKey = 'id';
    protected $allowedFields = ['userId', 'logementId', 'dateDebut', 'dateFin', 'nbrPersonne', 'prix'];

    public function getReservationsByUserId($userId)
    {
        return $this->where('userId', $userId)->findAll();
    }

    public function exists($id)
    {
        return $this->where('id', $id)->countAllResults() > 0;
    }
}
