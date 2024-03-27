<?php

namespace App\Controllers;

class FacilitiesController extends BaseController
{   
    public function facilities()
    {
        // Charger la vue du header
        $header = view('template/header');

        // Charger la vue des installations
        $facilities = view('facilities');

        // Charger la vue du footer
        $footer = view('template/footer');

        // Retourner toutes les vues concaténées
        return $header . $facilities . $footer;
    }
}
