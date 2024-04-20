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

        
        $materiel2 = $this->materielModel->where('categorie', 'imprimante')->where('reserver', 0)->findAll();
        $data['materiels']['imprimante'] = $materiel2;
        $data['nbr_materiel_type2'] = count($materiel2);

        
        $materiel3 = $this->materielModel->where('categorie', 'internet')->where('reserver', 0)->findAll();
        $data['materiels']['internet'] = $materiel3;
        $data['nbr_materiel_type3'] = count($materiel3);

        
        $materiel4 = $this->materielModel->where('categorie', 'video')->where('reserver', 0)->findAll();
        $data['materiels']['video'] = $materiel4;
        $data['nbr_materiel_type4'] = count($materiel4);

        $materiel5 = $this->materielModel->where('categorie', 'accessoire')->where('reserver', 0)->findAll();
        $data['materiels']['accessoire'] = $materiel5;
        $data['nbr_materiel_type5'] = count($materiel5);


        $materiel = view('pages/materiel',$data);
        return $this->header . $this->navbar . $materiel . $this->footer;
    }

    public function type1(): string{
        $materiel1 = $this->materielModel->where('categorie', 'informatique')->where('reserver', 0)->findAll();
        $data['materiels'] = $materiel1; 
        $data['nbr_materiel_type1'] = count($materiel1);
    
        $type1 = view('pages/materiel/type1', $data);
        return $this->header . $this->navbar . $type1 . $this->footer;
    }

    public function type2() : string{
        $materiel2 = $this->materielModel->where('categorie', 'imprimante')->where('reserver', 0)->findAll();
        $data['materiels'] = $materiel2;
        $data['nbr_materiel_type2'] = count($materiel2);

    
        $type2 = view('pages/materiel/type2', $data);
        return $this->header . $this->navbar . $type2 . $this->footer;
    }

    public function type3() : string{
        $materiel3 = $this->materielModel->where('categorie', 'internet')->where('reserver', 0)->findAll();
        $data['materiels'] = $materiel3;
        $data['nbr_materiel_type3'] = count($materiel3);

        $type3 = view('pages/materiel/type3', $data);
        return $this->header . $this->navbar . $type3 . $this->footer;
    }

    public function type4() : string{
        $materiel4 = $this->materielModel->where('categorie', 'video')->where('reserver', 0)->findAll();
        $data['materiels'] = $materiel4;
        $data['nbr_materiel_type4'] = count($materiel4);

        $type4 = view('pages/materiel/type4', $data);
        return $this->header . $this->navbar . $type4 . $this->footer;

    }

    public function type5() : string{
        
        $materiel5 = $this->materielModel->where('categorie', 'accessoire')->where('reserver', 0)->findAll();
        $data['materiels'] = $materiel5;
        $data['nbr_materiel_type5'] = count($materiel5);

        $type5 = view('pages/materiel/type5', $data);
        return $this->header . $this->navbar . $type5 . $this->footer;

    }
 }
