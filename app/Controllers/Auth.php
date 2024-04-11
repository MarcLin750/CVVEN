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
        $method = $this->request->getMethod('true');
        
        if($method === "POST"){
            $data = $this->request->getPost();
            
            $userModel = new \App\Models\Users();

            $user = $userModel->where('mail', $data['mail'])->first();

            if(!$user){
                return redirect()->back()->withInput()->with('errors',['mail' => 'Le mail saisi n\'existe pas']);
            }
           
            $password = password_verify($data['mdp'], $user->mdp);
            if (!$password) {
                return redirect()->back()->withInput()->with('errors', ['mdp' => 'Le mot de passe ne correspond pas']);
            }

            session()->set('user',[
                'id'=>$user->id,
                'nom'=>$user->nom,
                'prenom'=>$user->prenom,
                'mail'=>$user->mail,
            ]);
            return redirect()->to(base_url('users/profil'));
        }
        return $this->header . $this->navbar . $this->login . $this->footer;
    }
    
    public function register(){
        $method = $this->request->getMethod('true');
        
        if($method === "POST"){
            var_dump("Post true");
            $data = $this->request->getPost();
            $rules =[
                'nom' => 'required|max_length[255]|min_length[3]',
                'prenom' => 'required|max_length[255]|min_length[3]',
                'mail' => 'required|valid_email|is_unique[users.mail]',
                'mdp' =>'required|min_length[8]',
                'mdpConfirmed' =>'required|matches[mdp]'
            ];
            
            //Si les regles ne sont pas appliquées on retourne les erreurs de l'utilisateur
            if(!$this->validate($rules)){
                session()->setFlashdata('errors', $this->validator->getErrors());
                return redirect()->back()->withInput();
            }
            
            $data['mdp'] = password_hash($data['mdp'],PASSWORD_BCRYPT);
            
            $userModel = new \App\Models\Users();
            
            if(!$userModel->save($data)){
                session()->setFlashdata('errors', $userModel->errors());
                return redirect()->back()->withInput();
            }
            return redirect()->to(base_url('auth/login'));
        }
        
        return $this->header . $this->navbar . $this->register . $this->footer;
    }
    
    public function logout(){
        $this->session->destroy();
        return redirect()->to(base_url('/'));
    }
}


/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */