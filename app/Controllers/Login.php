<?php
class Login extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
    }

    public function index() {
        $this->load->view('login_view');
    }

    public function process_login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $user = $this->User_model->verify_user($username, $password);

        if ($user) {
            $this->session->set_userdata('user_id', $user['id']);
            redirect('admin_panel');
        } else {
            // Gérer l'erreur de connexion
            redirect('login');
        }
    }
}
?>
