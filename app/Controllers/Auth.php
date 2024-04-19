<?php

namespace App\Controllers;

class Auth extends BaseController
{
    protected $header;
    protected $navbar;
    protected $login;
    protected $register;
    protected $footer;

    public function __construct()
    {
        $this->header = view('template/header');
        $this->navbar = view('components/navbar');
        $this->login = view('components/login');
        $this->register = view('components/register');
        $this->footer = view('template/footer');
    }
    public function login()
    {
        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();

            $userModel = new \App\Models\Users();
            $user = $userModel->where('mail', $data['mail'])->first();

            if (!$user) {
                return redirect()->back()->withInput()->with('errors', ['mail' => 'Le mail saisi n\'existe pas']);
            }

            if (!password_verify($data['mdp'], $user->mdp)) {
                return redirect()->back()->withInput()->with('errors', ['mdp' => 'Le mot de passe ne correspond pas']);
            }

            $sessionData = [
                'id' => $user->id,
                'nom' => $user->nom,
                'prenom' => $user->prenom,
                'mail' => $user->mail,
                'isLoggedIn' => true
            ];

            if ($user->mail === 'admin77420@gmail.com') {
                $sessionData['isAdmin'] = true;
            }

            session()->set('user', $sessionData);

            return redirect()->to('/users/profil');
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
                'mdp' =>'required|min_length[8]',
                'mdpConfirmed' =>'required|matches[mdp]'
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
            
            return redirect()->to('/auth/login');
        }
        
        return $this->header . $this->navbar . $this->register . $this->footer;
    }
    
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
