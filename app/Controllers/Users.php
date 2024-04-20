<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Users extends BaseController
{
    public function profil(): string
    {
        // Charger la vue du header
        $header = view('template/header');
        
        // add other content
        $navbar = view('components/navbar');

        // Charger la vue de la page d'accueil
        $profil = view('components/profil');
        
        // Charger la vue du footer
        $footer = view('template/footer');

        // Concaténer les vues du header, du contenu et du footer
        return $header . $navbar . $profil . $footer;
    }
}