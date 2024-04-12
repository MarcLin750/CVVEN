<?php

namespace App\Controllers;

use App\Models\LogementModel;

class Logement extends BaseController
{
    
    protected $header;
    protected $navbar;

    protected $register;

    protected $footer;
    public function __construct() 
    {
        $this->header = view('template/header');
        $this->navbar = view('components/navbar');

        $this->register = view('components/register');

        $this->footer = view('template/footer');
    }
    public function view(): string
    {

        // Charger les données de la table logement
        $logementModel = new LogementModel();
        $data['logements'] = $logementModel->findAll();

        // Compter le nombre de logements de catégorie 1
        $data['nb_logements_cat_1'] = $logementModel->countCategory1();
        $data['nb_logements_cat_2'] = $logementModel->countCategory2();
        $data['nb_logements_cat_3'] = $logementModel->countCategory3();
        $data['nb_logements_cat_4'] = $logementModel->countCategory4();
        $data['nb_logements_cat_5'] = $logementModel->countCategory5();

        // Charger la vue de la page logements et passer les données
        $logement = view('pages/logement', $data);

        // Concaténer les vues du header, du contenu et du footer
        return $this->header . $this->navbar . $logement . $this->footer;
    }

    

}
