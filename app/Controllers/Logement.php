<?php

namespace App\Controllers;

use App\Models\LogementModel;
use App\Models\ReservationModel;

class Logement extends BaseController
{
    protected $header;
    protected $navbar;
    protected $footer;

    protected $logementModel;
    protected $reservationModel;

    public function __construct()
    {
        $this->header = view('template/header');
        $this->navbar = view('components/navbar');
        $this->footer = view('template/footer');

        $this->logementModel = new LogementModel();
        $this->reservationModel = new ReservationModel();
    }

    public function view(): string
    {
        // Charger la vue de la page logements et passer les données
        $data['logements'] = [];
        $data['nbr_logement_type1'] = 0;
        $data['nbr_logement_type2'] = 0;
        $data['nbr_logement_type3'] = 0;
        $data['nbr_logement_type4'] = 0;
        $data['nbr_logement_type5'] = 0;

        // Récupérer les logements de chaque catégorie et compter le nombre de logements pour chaque catégorie
        // Filtrer les logements par catégorie et par réservation
        $logements1 = $this->logementModel->where('categorie', 1)->where('reserver', 0)->findAll();
        $data['logements'][1] = $logements1;
        $data['nbr_logement_type1'] = count($logements1);

        $logements2 = $this->logementModel->where('categorie', 2)->where('reserver', 0)->findAll();
        $data['logements'][2] = $logements2;
        $data['nbr_logement_type2'] = count($logements2);

        $logements3 = $this->logementModel->where('categorie', 3)->where('reserver', 0)->findAll();
        $data['logements'][3] = $logements3;
        $data['nbr_logement_type3'] = count($logements3);

        $logements4 = $this->logementModel->where('categorie', 4)->where('reserver', 0)->findAll();
        $data['logements'][4] = $logements4;
        $data['nbr_logement_type4'] = count($logements4);

        $logements5 = $this->logementModel->where('categorie', 5)->where('reserver', 0)->findAll();
        $data['logements'][5] = $logements5;
        $data['nbr_logement_type5'] = count($logements5);

        $logement = view('pages/logement', $data);

        // Concaténer les vues du header, du contenu et du footer
        return $this->header . $this->navbar . $logement . $this->footer;
    }

    public function type1(): string
    {
        $logements1 = $this->logementModel->where('categorie', 1)->where('reserver', 0)->findAll();
        $data['logements'] = $logements1;
        $data['nbr_logement_type1'] = count($logements1);
        $type1 = view('pages/logement/type1', $data);
        return $this->header . $this->navbar . $type1 . $this->footer;
    }
    public function type2(): string
    {
        $logements2 = $this->logementModel->where('categorie', 2)->where('reserver', 0)->findAll();
        $data['logements'] = $logements2;
        $data['nbr_logement_type2'] = count($logements2);
        $type2 = view('pages/logement/type2', $data);
        return $this->header . $this->navbar . $type2 . $this->footer;
    }
    public function type3(): string
    {
        $logements3 = $this->logementModel->where('categorie', 3)->where('reserver', 0)->findAll();
        $data['logements'] = $logements3;
        $data['nbr_logement_type3'] = count($logements3);
        $type3 = view('pages/logement/type3', $data);
        return $this->header . $this->navbar . $type3 . $this->footer;
    }
    public function type4(): string
    {
        $logements4 = $this->logementModel->where('categorie', 4)->where('reserver', 0)->findAll();
        $data['logements'] = $logements4;
        $data['nbr_logement_type4'] = count($logements4);
        $type4 = view('pages/logement/type4', $data);
        return $this->header . $this->navbar . $type4 . $this->footer;
    }
    public function type5(): string
    {
        $logements5 = $this->logementModel->where('categorie', 5)->where('reserver', 0)->findAll();
        $data['logements'] = $logements5;
        $data['nbr_logement_type5'] = count($logements5);
        $type5 = view('pages/logement/type5', $data);
        return $this->header . $this->navbar . $type5 . $this->footer;
    }

    public function getLogement($id)
    {
        $logement = $this->logementModel->getLogementById($id);
    
        if ($logement) {
            // Vérifier si le formulaire a été soumis
            if ($this->request->getMethod() === 'post') {
                
                // Ajouter des règles de validation
                $rules = [
                    'start_date' => 'required|valid_date',
                    'end_date' => 'required|valid_date',
                    'nbr_personne' => 'required|max_length[1]'
                ];

                // Vérifier si les règles de validation sont respectées
                if (!$this->validate($rules)) {
                    // session()->setFlashdata('errors', $this->validator->getErrors());
                    // return redirect()->back()->withInput();
                    // Si les règles de validation ne sont pas respectées, afficher à nouveau la vue du formulaire avec les erreurs de validation
                    $data['logement'] = $logement;
                    $data['validation'] = $this->validator; // Passer les erreurs de validation à la vue
                    return $this->header . $this->navbar . view('pages/logement/form', $data) . $this->footer;
                }

                var_dump($this->request->getPost());
            
                // Traitement des données du formulaire de réservation
                $formData = $this->request->getPost();
            
                // Calculer le prix total
                $startDate = new \DateTime($this->request->getPost('start_date'));
                $endDate = new \DateTime($this->request->getPost('end_date'));
                $diffDays = $startDate->diff($endDate)->days + 1;
                $totalPrice = $diffDays * $logement["prix"];
            
                // Insérer les données dans la table de réservation
                $reservationData = [
                    'start_date' => $startDate->format('Y-m-d'),
                    'end_date' => $endDate->format('Y-m-d'),
                    'nbr_personne' => $this->request->getPost('nbr_personne'),
                    'prix_total' => $totalPrice,
                    'user_id' => NULL
                ];

                $this->reservationModel->insert($reservationData);
            
                // Mettre à jour la colonne reserve de la table logement à true
                $this->logementModel->update($id, ['reserver' => 1]);
            
                // Rediriger l'utilisateur vers une page de confirmation
                return redirect()->to('/');
            } else {
                // Passer les données du logement à la vue
                $data['logement'] = $logement;
            
                // Concaténer les vues du header, du contenu et du footer
                return $this->header . $this->navbar . view('pages/logement/form', $data) . $this->footer;
            }
        } else {
            // Rediriger vers la page d'erreur 404
            return $this->header . $this->navbar . view('errors/html/error_404') . $this->footer;
        }
    }
}
