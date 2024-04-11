<?php

namespace App\Controllers;

use App\Models\LogementModel;

class Logement extends BaseController
{
    public function view(): string
    {
        // Charger la vue du header
        $header = view('template/header');

        // add other content
        $navbar = view('components/navbar');

        // Charger les données de la table logement
        $logementModel = new LogementModel();
        $data['logements'] = $logementModel->findAll();

        // Compter le nombre de logements de catégorie 1
        $data['nb_logements_cat_1'] = $logementModel->countCategory1();

        // Charger la vue de la page logements et passer les données
        $logement = view('pages/logement', $data);

        // Charger la vue du footer
        $footer = view('template/footer');

        // Concaténer les vues du header, du contenu et du footer
        return $header . $navbar . $logement . $footer;
    }
}
