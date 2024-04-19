<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservationModel extends Model
{
    protected $table = 'reservation';
    protected $primaryKey = 'id'; 
    protected $allowedFields = ['dateDebut', 'dateFin', 'nbrPersonne', 'prix', 'userId']; 
}