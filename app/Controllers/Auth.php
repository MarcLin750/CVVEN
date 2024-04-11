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

            $userCheck = $userModel->where('email', $data['email'])->first();
            if(!$userCheck){
                return redirect()->back()->withInput()->with('errors',['email' => 'L\'email saisi n\'existe pas']);
            }
           
            $passwordCheck = password_verify($data['password'], $user->password);
            if (!$passwordCheck) {
                return redirect()->back()->withInput()->with('errors', ['password' => 'Le mot de passe ne correspond pas']);
            }

            session()->set('user',[
                'id'=>$user->id,
                'last_name'=>$user->last_name,
                'first_name'=>$user->first_name,
                'email'=>$user->email,
            ]);
            return redirect()->to(base_url('users/profil'));
        }
        return $this->header . $this->navbar . $this->login . $this->footer;
    }
    
    public function register(){
        $method = $this->request->getMethod('true');
        
        if($method === "POST"){
            $data = $this->request->getPost();
            $rules =[
                'last_name' => 'required|max_length[255]|min_length[3]',
                'first_name' => 'required|max_length[255]|min_length[3]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' =>'required|min_length[8]',
                'passwordConfirm' =>'required|matches[password]'
            ];
            
            //Si les regles ne sont pas appliquées on retourne les erreurs de l'utilisateur
            if(!$this->validate($rules)){
                session()->setFlashdata('errors', $this->validator->getErrors());
                return redirect()->back()->withInput();
            }
            
            $data['password'] = password_hash($data['password'],PASSWORD_BCRYPT);
            
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