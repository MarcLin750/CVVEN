<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\Users;
use App\Models\LogementModel;
use App\Models\ReservationModel;

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
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/admin/login');
        }

        $data['reservations'] = $this->reservationModel->findAll();

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

    public function confirmReservation($id)
    {
        $this->reservationModel->update($id, ['status' => 'confirmed']);
        return redirect()->to('/admin/dashboard');
    }

    public function cancelReservation($id)
    {
        // $this->reservationModel->delete($id);
        $this->logementModel->update($id, ['reserver' => 0]);
        return redirect()->to('/admin/dashboard');
    }
}
