<?php

namespace App\Controllers;

class Auth extends BaseController
{
    protected $header;
    protected $navbar;
    protected $footer;

    protected $login;
    protected $register;

    public function __construct()
    {
        $this->header = view('template/header');
        $this->navbar = view('components/navbar');
        $this->footer = view('template/footer');
    
        $this->login = view('components/login');
        $this->register = view('components/register');
    }

    public function login()
    {
        if ($this->request->getMethod() === 'post') {

            $sessionData = [];
            $data = $this->request->getPost();

            $userModel = new \App\Models\Users();
            $user = $userModel->where('mail', $data['mail'])->first();

            $Admin_Model = new \App\Models\Admin_Model();
            $admin = $Admin_Model->where('mail', $data['mail'])->first();

            // condition d'authentification user
            if ($user) {
                if (password_verify($data['mdp'], $user->mdp)) {
                    $sessionData += [
                        'id' => $user->id,
                        'nom' => $user->nom,
                        'prenom' => $user->prenom,
                        'mail' => $user->mail,
                        'isLoggedIn' => true
                    ];
                    // condition d'authentification admin
                    if ($admin) {
                        if (password_verify($data['mdp'], $user->mdp)) {
                            $sessionData += [
                                'isAdmin' => true,
                                'isLoggedIn' => true
                            ];
                        }
                    }
                    session()->set('user', $sessionData);
                    return redirect()->to('/logement');
                }
            }
            return redirect()->back()->withInput()->with('errors', ['mail' => 'Le mail ou mot de passe ne correspond pas.']);
        }

        return $this->header . $this->navbar . $this->login . $this->footer;
    }
    
    public function register()
    {
        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();
            $rules = [
                'nom' => 'required|max_length[255]|min_length[3]',
                'prenom' => 'required|max_length[255]|min_length[3]',
                'mail' => 'required|valid_email|is_unique[users.mail]',
                'mdp' => 'required|min_length[8]',
                'mdpConfirmed' => 'required|matches[mdp]'
            ];
            
            if (!$this->validate($rules)) {
                session()->setFlashdata('errors', $this->validator->getErrors());
                return redirect()->back()->withInput();
            }
            
            $data['mdp'] = password_hash($data['mdp'], PASSWORD_BCRYPT);
            $userModel = new \App\Models\Users();
            
            if (!$userModel->save($data)) {
                session()->setFlashdata('errors', $userModel->errors());
                return redirect()->back()->withInput();
            }
            
            return redirect()->to('/success/register/');
        }
        
        return $this->header . $this->navbar . $this->register . $this->footer;
    }
    
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}