<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\ReservationModel;
use App\Models\LogementModel; 

class Users extends BaseController
{
    protected $reservationModel;
    protected $logementModel;


    public function __construct()
    {
        $this->reservationModel = new ReservationModel();
        $this->logementModel = new LogementModel(); 
    }

    public function profil($id): string
    {
        // Charger la vue du header
        $header = view('template/header');
        
        // add other content
        $navbar = view('components/navbar');

        // Charger la vue du footer
        $footer = view('template/footer');
        
        $data['reservations'] = $this->reservationModel->where('status', 'confirmed')->where('userId', $id)->findAll();
        $data['users'] = [];

        // Charger la vue de la page d'accueil
        $profil = view('components/profil', $data);
        
        // Concaténer les vues du header, du contenu et du footer
        return $header . $navbar . $profil . $footer;
    }
    
    public function cancelReservation($userId, $reservationId, $logementId)
    {
        // $this->reservationModel->delete($id);
        $this->reservationModel->update($reservationId, ['status' => 'cancel']);
        $this->logementModel->update($logementId, ['reserver' => 0]);
        return redirect()->to('users/' . $userId);
    }
}