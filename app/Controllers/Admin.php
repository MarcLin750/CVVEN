<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\Users;
use App\Models\LogementModel;
use App\Models\ReservationModel;
use App\Models\MaterielModel;
use App\Models\ReservationMaterielModel;

class Admin extends BaseController
{
    protected $header;
    protected $navbar;
    protected $footer;

    protected $adminModel;
    protected $session;
    protected $validation;

    protected $users;
    protected $logementModel;
    protected $reservationModel;
    protected $materielModel;
    protected $reservationMaterielModel;

    public function __construct()
    {
        // Déclarer le header, la navbar et le footer
        $this->header = view('template/header');
        $this->navbar = view('components/navbar');
        $this->footer = view('template/footer');

        // Initialiser les modèles, la session et la validation
        $this->adminModel = new \App\Models\Admin_Model();
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();

        // Charger les modèles
        $this->users = new Users();
        $this->logementModel = new LogementModel();
        $this->reservationModel = new ReservationModel();
        $this->materielModel = new MaterielModel();
        $this->reservationMaterielModel = new ReservationMaterielModel();
    }

    public function index()
    {
        $data['reservations'] = $this->reservationModel->getReservationsWithDetails();
        
        return $this->header . $this->navbar . view('admin/dashboard', $data) . $this->footer;
    }

    public function login()
    {
        return $this->header . $this->navbar . view('admin/login') . $this->footer;
    }

    public function register()
    {
        return $this->header . $this->navbar . view('admin/register') . $this->footer;
    }

    public function dashboard()
    {
        // if (!$this->session->get('logged_in')) {
        //     return redirect()->to('/admin/login');
        // }

        // récupération des données pour afficher les réservations de logement.
        $reservations = $this->reservationModel->where('status !=', 'refuse')->where('status !=', 'cancel')->where('status !=', 'change')->findAll();
        $reservationsUsers = [];
        foreach ($reservations as $reservation) {
            // Récupérez l'utilisateur correspondant à l'ID de l'utilisateur de la réservation
            $user = $this->users->find($reservation['userId']);
            // Ajoutez l'utilisateur à la réservation
            $reservation['user'] = $user;
            // Ajoutez la réservation avec l'utilisateur au tableau
            $reservationsUsers[] = $reservation;
        }
        $data['reservations'] = $reservationsUsers;
        // récupération des données pour afficher les réservations de logement annuler.
        $reservationsCancel = $this->reservationModel->whereIn('status', ['cancel', 'refuse'])->findAll();
        $reservationsCancelUsers = [];
        foreach ($reservationsCancel as $reservation) {
            // Récupérez l'utilisateur correspondant à l'ID de l'utilisateur de la réservation
            $user = $this->users->find($reservation['userId']);
            // Ajoutez l'utilisateur à la réservation
            $reservation['user'] = $user;
            // Ajoutez la réservation avec l'utilisateur au tableau
            $reservationsCancelUsers[] = $reservation;
        }
        $data['reservationsCancel'] = $reservationsCancelUsers;
    
        // récupération des données pour afficher les réservations de materiel.
        $reservationMateriels = $this->reservationMaterielModel->where('status !=', 'refuse')->where('status !=', 'cancel')->findAll();
        $reservationsMaterielUsers = [];
        foreach ($reservationMateriels as $reservationMateriel) {
            // Récupérez l'utilisateur correspondant à l'ID de l'utilisateur de la réservation
            $user = $this->users->find($reservationMateriel['user_id']);
            $materielModel = $this->materielModel->find($reservationMateriel['materiel_id']);
            // Ajoutez l'utilisateur à la réservation
            $reservationMateriel['user'] = $user;
            $reservationMateriel['materielModel'] = $materielModel;
            // Ajoutez la réservation avec l'utilisateur au tableau
            $reservationsMaterielUsers[] = $reservationMateriel;
        }
        $data['reservationMateriels'] = $reservationsMaterielUsers;
        // récupération des données pour afficher les réservations de materiel annuler.
        $reservationMaterielCancels = $this->reservationMaterielModel->whereIn('status', ['cancel', 'refuse'])->findAll();
        $reservationMaterielCancelUsers = [];
        foreach ($reservationMaterielCancels as $reservationMateriel) {
            // Récupérez l'utilisateur correspondant à l'ID de l'utilisateur de la réservation
            $user = $this->users->find($reservationMateriel['user_id']);
            $materielModel = $this->materielModel->find($reservationMateriel['materiel_id']);
            // Ajoutez l'utilisateur à la réservation
            $reservationMateriel['user'] = $user;
            $reservationMateriel['materielModel'] = $materielModel;
            // Ajoutez la réservation avec l'utilisateur au tableau
            $reservationMaterielCancelUsers[] = $reservationMateriel;
        }
        $data['reservationMaterielCancels'] = $reservationMaterielCancelUsers;
    
        // Utiliser le header, la navbar et le footer dans la méthode dashboard
        return $this->header . $this->navbar . view('admin/dashboard', $data) . $this->footer;
    }


    public function login_validation()
    {
        $mail = $this->request->getPost('mail');
        $password = $this->request->getPost('password');
        if ($this->adminModel->can_login($mail, $password)) {
            $session_data = [
                'mail' => $mail,
                'logged_in' => TRUE
            ];
            $this->session->set($session_data);
            return redirect()->to('/admin/dashboard');
        } else {
            $this->session->setFlashdata('error', 'Invalid Username and Password');
            return redirect()->to('/admin/login');
        }
    }

    public function register_validation()
    {
        $this->validation->setRules([
            'nom' => 'required',
            'prenom' => 'required',
            'mail' => 'required|valid_email|is_unique[admin.mail]',
            'password' => 'required',
        ]);

        if ($this->validation->withRequest($this->request)->run()) {
            $data = [
                'nom' => $this->request->getPost('nom'),
                'prenom' => $this->request->getPost('prenom'),
                'mail' => $this->request->getPost('mail'),
                'mdp' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            ];

            if ($this->adminModel->register_admin($data)) {
                return redirect()->to('/admin/login');
            } else {
                return redirect()->back()->withInput()->with('error', 'Registration failed!');
            }
        } else {
            $errors = $this->validation->getErrors();
            return redirect()->back()->withInput()->with('errors', $errors);
        }
    }

    public function showUsers()
    {
        $data['users'] = $this->users->findAll();
        // Utiliser le header, la navbar et le footer dans la méthode showUsers
        return $this->header . $this->navbar . view('admin/users', $data) . $this->footer;
    }

    public function deleteUser($id)
    {
        $this->users->delete($id);
        return redirect()->to('/admin/users');
    }

    // Fonction pour la réservation logement
    public function validateReservation($reservationId)
    {
        $this->reservationModel->update($reservationId, ['status' => 'validate']);
        return redirect()->to('/admin/dashboard');
    }
    public function refuseReservation($reservationId, $logementId)
    {
        $this->reservationModel->update($reservationId, ['status' => 'refuse']);
        $this->logementModel->update($logementId, ['reserver' => 0]);
        return redirect()->to('/admin/dashboard');
    }
    public function goBackReservation($reservationId, $logementId)
    {
        $this->reservationModel->update($reservationId, ['status' => 'wait']);
        $this->logementModel->update($logementId, ['reserver' => 1]);
        return redirect()->to('/admin/dashboard');
    }
    public function deleteReservation($reservationId)
    {
        $this->reservationModel->delete($reservationId);
        return redirect()->to('/admin/dashboard');
    }

    // Fonction pour la réservation de materiel
    public function validateReservationMateriel($reservationId)
    {
        $this->reservationMaterielModel->update($reservationId, ['status' => 'validate']);
        return redirect()->to('/admin/dashboard');
    }
    public function refuseReservationMateriel($reservationId, $materielId)
    {
        $this->reservationMaterielModel->update($reservationId, ['status' => 'refuse']);
        $this->materielModel->update($materielId, ['reserver' => 0]);
        return redirect()->to('/admin/dashboard');
    }
    public function goBackReservationMateriel($reservationId, $materielId)
    {
        $this->reservationMaterielModel->update($reservationId, ['status' => 'wait']);
        $this->materielModel->update($materielId, ['reserver' => 1]);
        return redirect()->to('/admin/dashboard');
    }
    public function deleteReservationMateriel($reservationId)
    {
        $this->reservationMaterielModel->delete($reservationId);
        return redirect()->to('/admin/dashboard');
    }
}
