<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MaterielModel;
use App\Models\ReservationMaterielModel;
use CodeIgniter\HTTP\ResponseInterface;

class Materiel extends BaseController
{
    protected $header;
    protected $navbar;
    protected $footer;

    protected $materielModel;
    protected $reservationMaterielModel;

    public function __construct()
    {
        $this->header = view('template/header');
        $this->navbar = view('components/navbar');
        $this->footer = view('template/footer');

        $this->materielModel = new MaterielModel();
        $this->reservationMaterielModel = new ReservationMaterielModel();
    }
    public function view()
    {

        $data['materiels'] = [];
        $data['nbr_materiel_type1'] = 0;
        

        $materiel1 = $this->materielModel->where('categorie', 'informatique')->where('reserver', 0)->findAll();
        $data['materiels']['categorie'] = $materiel1;
        $data['nbr_materiel_type1'] = count($materiel1);

        $materiel = view('pages/materiel');
        return $this->header . $this->navbar . $materiel . $this->footer;
    }

    public function type1(): string{
        $materiel1 = $this->materielModel->where('categorie', 'informatique')->where('reserver', 0)->findAll();
        $data['materiels'] = $materiel1; // Supprimez le niveau de l'indice 'informatique'
        $data['nbr_materiel_type1'] = count($materiel1);
    
        $type1 = view('pages/materiel/type1', $data);
        return $this->header . $this->navbar . $type1 . $this->footer;
    }
}
