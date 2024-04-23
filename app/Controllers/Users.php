<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\LogementModel;
use App\Models\ReservationModel;
use App\Models\MaterielModel;
use App\Models\ReservationMaterielModel;

class Users extends BaseController
{
    protected $logementModel;
    protected $reservationModel;

    protected $materielModel;
    protected $reservationMaterielModel;

    public function __construct()
    {
        $this->logementModel = new LogementModel(); 
        $this->reservationModel = new ReservationModel();

        $this->materielModel = new MaterielModel();
        $this->reservationMaterielModel = new ReservationMaterielModel();
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

        // récupération des données pour afficher les réservations de materiel.
        $reservationMateriels = $this->reservationMaterielModel->where('status', 'confirmed')->where('user_id', $id)->findAll();
        $reservationsMaterielDetails = [];
        foreach ($reservationMateriels as $reservationMateriel) {
            $materielModel = $this->materielModel->find($reservationMateriel['materiel_id']);
            $reservationMateriel['materielModel'] = $materielModel;
            $reservationsMaterielDetails[] = $reservationMateriel;
        }
        $data['reservationMateriels'] = $reservationsMaterielDetails;

        // Charger la vue de la page d'accueil
        $profil = view('components/profil', $data);
        
        // Concaténer les vues du header, du contenu et du footer
        return $header . $navbar . $profil . $footer;
    }
    
    public function cancelReservation($userId, $reservationId, $logementId)
    {
        $this->reservationModel->update($reservationId, ['status' => 'cancel']);
        $this->logementModel->update($logementId, ['reserver' => 0]);
        return redirect()->to('users/' . $userId);
    }

    public function cancelReservationMateriel($userId, $reservationId, $materielId)
    {
        $this->reservationMaterielModel->update($reservationId, ['status' => 'cancel']);
        $this->materielModel->update($materielId, ['reserver' => 0]);
        return redirect()->to('users/' . $userId);
    }
}