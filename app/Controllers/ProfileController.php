<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\reservationModel; 
// Assurez-vous d'importer le modèle de réservation

class ProfileController extends BaseController
{
    public function index()
    {
        $session = session();
        $userId = $session->get('userId');

        

        $db = db_connect();
        $userQuery = $db->query("SELECT * FROM users WHERE id = ?", [$userId]);
        $user = $userQuery->getRowArray();

        $reservationsQuery = $db->query("SELECT * FROM reservation WHERE userId = ?", [$userId]);
        $reservations = $reservationsQuery->getResultArray();

        $data = [
            'user' => $user,
            'reservations' => $reservations
        ];

        return view('profile/index', $data);
    }
}

