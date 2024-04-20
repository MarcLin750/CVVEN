<?php

namespace App\Controllers;
use App\Models\UsersModel;
use App\Models\ReservationModel;
use App\Models\LogementModel;



use CodeIgniter\Controller;

class Admin extends BaseController
{
    protected $adminModel;
    protected $session;
    protected $validation;
    public function __construct()
    {
        $this->reservationModel = new ReservationModel();
    }
    public function index()
    {
        $reservationModel = new \App\Models\ReservationModel();
        $data['reservations'] = $reservationModel->getReservationsWithDetails();
        
        return view('admin/dashboard', $data);
    }

    public function initController($request, $response, $logger)
    {
        parent::initController($request, $response, $logger);

        // Load the Admin model correctly using the model's correct namespace and name
        $this->adminModel = new \App\Models\Admin_Model();

        // Load the session and validation library
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
    }

    public function login()
    {
        return view('admin/login');
    }

    public function register()
    {
        return view('admin/register');
    }

    public function dashboard()
    {
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/admin/login');
        }
        return view('admin/dashboard');
    }

    public function login_validation()
    {
        // Change 'email' to 'mail' to match the form and database schema
        $email = $this->request->getPost('mail');
        $password = $this->request->getPost('password');
        if ($this->adminModel->can_login($email, $password)) {
            $session_data = [
                'mail' => $email, // Change session key to 'mail' if necessary
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
    log_message('debug', 'Register validation method called.');  // Logging for debugging

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

        log_message('debug', 'Form data validated and ready for insertion: ' . print_r($data, true));  // Check the prepared data

        if ($this->adminModel->register_admin($data)) {
            log_message('debug', 'Data inserted successfully.');
            return redirect()->to('/admin/login');
        } else {
            log_message('error', 'Failed to insert data.');
            return redirect()->back()->withInput()->with('error', 'Registration failed!');
        }
    } else {
        $errors = $this->validation->getErrors();
        log_message('error', 'Validation failed: ' . print_r($errors, true));
        return redirect()->back()->withInput()->with('errors', $errors);
    }
}
    public function showUsers()
    {
        $model = new UsersModel();
        $data['users'] = $model->findAll();
        return view('admin/users', $data);
    }

    public function confirmReservation($id)
    {
        $model = new ReservationModel();
        $model->update($id, ['status' => 'confirmed']);
        return redirect()->to('/admin/dashboard');
    }

    public function cancelReservation($id)
    {
        $model = new ReservationModel();
        // Supprime la réservation avec l'ID donné
        $model->delete($id);
       
        return redirect()->to('/admin/dashboard');
    }

}