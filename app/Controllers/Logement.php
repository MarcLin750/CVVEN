<?php

namespace App\Controllers;

use App\Models\logementModel;

class Logement extends BaseController
{
    public function view(): string
    {
        // Charger la vue du header
        $header = view('template/header');
        
        // add other content
        $navbar = view('components/navbar');

        // Charger la vue de la page d'accueil
        $logement = view('pages/logement');
        
        // Charger la vue du footer
        $footer = view('template/footer');

        // Concaténer les vues du header, du contenu et du footer
        return $header . $navbar . $logement . $footer;
    }
}
