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
    public function index()
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

        $materiel5 = $this->materielModel->where('categorie', 'photocopieur')->where('reserver', 0)->findAll();
        $data['materiels']['photocopieur'] = $materiel5;
        $data['nbr_materiel_type5'] = count($materiel5);

        $materiel6 = $this->materielModel->where('categorie', 'accessoire')->where('reserver', 0)->findAll();
        $data['materiels']['accessoire'] = $materiel6;
        $data['nbr_materiel_type6'] = count($materiel6);

        $materiel7 = $this->materielModel->where('categorie', 'transmission')->where('reserver', 0)->findAll();
        $data['materiels']['transmission'] = $materiel7;
        $data['nbr_materiel_type7'] = count($materiel7);

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
        $materiel5 = $this->materielModel->where('categorie', 'photocopieur')->where('reserver', 0)->findAll();
        $data['materiels'] = $materiel5;
        $data['nbr_materiel_type5'] = count($materiel5);

        $type5 = view('pages/materiel/type5', $data);
        return $this->header . $this->navbar . $type5 . $this->footer;
    }

    public function type6() : string{
        
        $materiel6 = $this->materielModel->where('categorie', 'accessoire')->where('reserver', 0)->findAll();
        $data['materiels'] = $materiel6;
        $data['nbr_materiel_type6'] = count($materiel6);

        $type6 = view('pages/materiel/type6', $data);
        return $this->header . $this->navbar . $type6 . $this->footer;

    }

    public function type7() : string{
        $materiel7 = $this->materielModel->where('categorie', 'transmission')->where('reserver', 0)->findAll();
        $data['materiels'] = $materiel7;
        $data['nbr_materiel_type7'] = count($materiel7);

        
        $type7 = view('pages/materiel/type7', $data);
        return $this->header . $this->navbar . $type7 . $this->footer;
    }
    
    public function reserveMateriel($id)
    {
        $materiel = $this->materielModel->find($id);

        if ($materiel) {
            if ($this->request->getMethod() === 'post') {
                // Ajout des règles de validation si nécessaire

                // Traitement des données du formulaire de réservation
                $formData = $this->request->getPost();

                // Insére les données dans la table de réservation de matériel
                $reservationData = [
                    'dateDebut' => $formData['start_date'],
                    'dateFin' => $formData['end_date'],
                    'materiel_id' => $id,
                    'user_id' => session()->get('user')['id'], // Ou toute autre méthode pour récupérer l'ID de l'utilisateur connecté
                    'status' => 'wait'
                ];

                $this->reservationMaterielModel->insert($reservationData);

                // Met à jour la colonne reserver du matériel à true
                $this->materielModel->update($id, ['reserver' => 1]);

                // Redirige l'utilisateur vers une page de confirmation
                return redirect()->to('/success');
            } else {
                // Affiche le formulaire de réservation
                $data['materiel'] = $materiel;
                return $this->header . $this->navbar . view('pages/materiel/form', $data) . $this->footer;
            }
        }  else if (!$materiel) {
            // Défini un message d'erreur
            $data['message'] = "Le matériel demandé n'a pas été trouvé.";
            // Charge la vue d'erreur 404
            return view('errors/html/error_404', $data);
        }
    }
 }
