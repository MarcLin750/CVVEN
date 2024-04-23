<?php

namespace App\Controllers;

class Home extends BaseController
{
    protected $header;
    protected $navbar;
    protected $footer;

    public function __construct()
    {
        $this->header = view('template/header');
        $this->navbar = view('components/navbar');
        $this->footer = view('template/footer');
    }

    public function index(): string
    {
        // Charger la vue de la page d'accueil
        $home = view('pages/home');
        
        return $this->header . $this->navbar . $home . $this->footer;
    }
    
    public function success(): string
    {
        $success = view('pages/success');
        return $this->header . $this->navbar . $success . $this->footer;
    }

    public function register(): string
    {
        $register = view('pages/success_register');
        return $this->header . $this->navbar . $register . $this->footer;
    }

    public function contact(): string
    {
        $contact = view('pages/contact');

        return $this->header . $this->navbar . $contact . $this->footer;
    }
}
