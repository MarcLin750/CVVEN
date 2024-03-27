<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        // Charger la vue du header
        $header = view('template/header');

        // Charger la vue de la page d'accueil
        $content = view('index');

        // Charger la vue du footer
        $footer = view('template/footer');

        // Concaténer les vues du header, du contenu et du footer
        return $header . $content . $footer;
    }
}
