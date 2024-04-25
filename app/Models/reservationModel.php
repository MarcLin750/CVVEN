<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservationModel extends Model
{
    protected $table = 'reservation';
    protected $primaryKey = 'id';
    protected $allowedFields = ['dateDebut', 'dateFin', 'nbrPersonne', 'prix', 'devise', 'userId', 'logementId', 'status'];

    public function getReservationsByUserId($userId)
    {
        return $this->where('userId', $userId)->findAll();
    }

    public function getReservationById($id)
    {
        return $this->find($id);
    }

    public function exists($id)
    {
        return $this->where('id', $id)->countAllResults() > 0;
    }
}
