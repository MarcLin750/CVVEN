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

    protected $header;
    protected $navbar;
    protected $footer;

    public function __construct()
    {
        $this->logementModel = new LogementModel(); 
        $this->reservationModel = new ReservationModel();

        $this->materielModel = new MaterielModel();
        $this->reservationMaterielModel = new ReservationMaterielModel();

        $this->header = view('template/header');
        $this->navbar = view('components/navbar');
        $this->footer = view('template/footer');
    }

    public function profil($id): string
    {   
        $data['reservations'] = $this->reservationModel->where('status !=', 'cancel')->where('userId', $id)->findAll();

        // récupération des données pour afficher les réservations de materiel.
        $reservationMateriels = $this->reservationMaterielModel->where('status !=', 'cancel')->where('user_id', $id)->findAll();
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
        return $this->header . $this->navbar . $profil . $this->footer;
    }

    public function profilModify($id)
    {   
        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();
            $rules = [
                'nom' => 'required|max_length[255]|min_length[3]',
                'prenom' => 'required|max_length[255]|min_length[3]',
                'mail' => 'required|valid_email',
                'mdp' => 'required|min_length[8]',
            ];

            if (!$this->validate($rules)) {
                session()->setFlashdata('errors', $this->validator->getErrors());
                return redirect()->back()->withInput();
            }

            $userModel = new \App\Models\Users();
            $userData = $userModel->where('id', $id)->first();

            // Vérifier si l'email fourni correspond à celui de la base de données
            if ($userData->id !== $id) {
                session()->setFlashdata('errors', ['L\'utilisateur correspond pas à celui enregistré.']);
                return redirect()->back()->withInput();
            }

            // Vérifier si le mot de passe fourni correspond à celui de la base de données
            if (!password_verify($data['mdp'], $userData->mdp)) {
                session()->setFlashdata('errors', ['Le mot de passe fourni ne correspond pas à celui enregistré.']);
                return redirect()->back()->withInput();
            }

            // Si les vérifications sont réussies, mettre à jour les informations du profil
            unset($data['mdp']); // On ne met pas à jour le mot de passe dans cette méthode

            if (!$userModel->update($id, $data)) {
                session()->setFlashdata('errors', $userModel->errors());
                return redirect()->back()->withInput();
            }

            return redirect()->to('/users' . '/' . $id . '/modify/success');
        }

        $profilModify = view('components/profil_modify');

        return $this->header . $this->navbar . $profilModify . $this->footer;
    }

    public function modifySuccess(): string
    {   
        session()->destroy();

        $modifySuccess = view('components/profil_modify_success');
        
        return $this->header . $this->navbar . $modifySuccess . $this->footer;
    }

    public function cancelReservationMateriel($userId, $reservationId, $materielId)
    {
        $this->reservationMaterielModel->update($reservationId, ['status' => 'cancel']);
        $this->materielModel->update($materielId, ['reserver' => 0]);
        return redirect()->to('users/' . $userId);
    }
}