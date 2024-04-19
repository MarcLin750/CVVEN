<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservationLogementModel extends Model
{
    protected $table = 'reservation_logement';
    protected $allowedFields = ['reservationId', 'logementId'];
}
