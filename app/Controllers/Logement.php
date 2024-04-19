<?php

namespace App\Controllers;

use App\Models\LogementModel;

class Logement extends BaseController
{
    protected $header;
    protected $navbar;
    protected $footer;

    protected $logementData;
    protected $data;

    public function __construct()
    {
        $this->header = view('template/header');
        $this->navbar = view('components/navbar');
        $this->footer = view('template/footer');

        // Charger les données de la table logement
        $this->logementModel = new LogementModel();
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

    public function getLogement($id): string
    {
        // Récupérer les détails du logement avec l'ID donné
        $logement = $this->logementModel->getLogementById($id);

        // Vérifier si le logement existe
        if ($logement) {
            // Vérifier si le formulaire a été soumis
            if ($this->request->getMethod() === 'post') {
                // Traitement des données du formulaire de réservation
                $formData = $this->request->getPost();
                // Insérez le code pour valider et enregistrer les données de réservation dans la base de données
                // Rediriger l'utilisateur vers une page de confirmation ou une autre page appropriée
                return redirect()->to('/confirmation');
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