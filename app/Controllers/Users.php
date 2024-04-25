<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\LogementModel;
use App\Models\ReservationModel;
use App\Models\MaterielModel;
use App\Models\ReservationMaterielModel;

class Users extends BaseController
{
    protected $logementModel;
    protected $reservationModel;

    protected $materielModel;
    protected $reservationMaterielModel;

    protected $header;
    protected $navbar;
    protected $footer;

    public function __construct()
    {
        $this->logementModel = new LogementModel(); 
        $this->reservationModel = new ReservationModel();

        $this->materielModel = new MaterielModel();
        $this->reservationMaterielModel = new ReservationMaterielModel();

        $this->header = view('template/header');
        $this->navbar = view('components/navbar');
        $this->footer = view('template/footer');
    }

    public function profil($id): string
    {   
        $data['reservations'] = $this->reservationModel->where('status !=', 'cancel')->where('status !=', 'change')->where('userId', $id)->findAll();

        // récupération des données pour afficher les réservations de materiel.
        $reservationMateriels = $this->reservationMaterielModel->where('status !=', 'cancel')->where('user_id', $id)->findAll();
        $reservationsMaterielDetails = [];
        foreach ($reservationMateriels as $reservationMateriel) {
            $materielModel = $this->materielModel->find($reservationMateriel['materiel_id']);
            $reservationMateriel['materielModel'] = $materielModel;
            $reservationsMaterielDetails[] = $reservationMateriel;
        }
        $data['reservationMateriels'] = $reservationsMaterielDetails;

        // Charger la vue de la page d'accueil
        $profil = view('components/profil', $data);
        
        // Concaténer les vues du header, du contenu et du footer
        return $this->header . $this->navbar . $profil . $this->footer;
    }

    public function profilModify($id)
    {   
        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();
            $rules = [
                'nom' => 'required|max_length[255]|min_length[3]',
                'prenom' => 'required|max_length[255]|min_length[3]',
                'mail' => 'required|valid_email',
                'mdp' => 'required|min_length[8]',
            ];

            if (!$this->validate($rules)) {
                session()->setFlashdata('errors', $this->validator->getErrors());
                return redirect()->back()->withInput();
            }

            $userModel = new \App\Models\Users();
            $userData = $userModel->where('id', $id)->first();

            // Vérifier si l'email fourni correspond à celui de la base de données
            if ($userData->id !== $id) {
                session()->setFlashdata('errors', ['L\'utilisateur correspond pas à celui enregistré.']);
                return redirect()->back()->withInput();
            }

            // Vérifier si le mot de passe fourni correspond à celui de la base de données
            if (!password_verify($data['mdp'], $userData->mdp)) {
                session()->setFlashdata('errors', ['Le mot de passe fourni ne correspond pas à celui enregistré.']);
                return redirect()->back()->withInput();
            }

            // Si les vérifications sont réussies, mettre à jour les informations du profil
            unset($data['mdp']); // On ne met pas à jour le mot de passe dans cette méthode

            if (!$userModel->update($id, $data)) {
                session()->setFlashdata('errors', $userModel->errors());
                return redirect()->back()->withInput();
            }

            return redirect()->to('/users' . '/' . $id . '/modify/success');
        }

        $profilModify = view('components/profil_modify');

        return $this->header . $this->navbar . $profilModify . $this->footer;
    }

    public function modifySuccess(): string
    {   
        session()->destroy();

        $modifySuccess = view('components/profil_modify_success');
        
        return $this->header . $this->navbar . $modifySuccess . $this->footer;
    }

    public function reservationChange($userId, $reservationId, $logementId){
        
        $reservation = $this->reservationModel->getReservationById($reservationId);
        
        $logement = $this->logementModel->getLogementById($logementId);

        if ($reservation) {
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
                    // Si les règles de validation ne sont pas respectées, afficher à nouveau la vue du formulaire avec les erreurs de validation
                    $data['reservation'] = $reservation;
                    $data['validation'] = $this->validator; // Passer les erreurs de validation à la vue
                    return $this->header . $this->navbar . view('components/reservationChange', $data) . $this->footer;
                }

                // Traitement des données du formulaire de réservation
                $formData = $this->request->getPost();

                $startDate = strtotime($formData['start_date']);
                $endDate = strtotime($formData['end_date']);
                $diffDays = ceil(($endDate - $startDate) / (60 * 60 * 24));
                $userSession = session()->get('user');
                
                if($formData['devise'] === "€"){
                    $totalPrice = $diffDays * $logement["prix"];
                } elseif($formData['devise'] === "$") {
                    $newPrice = $logement["prix"] * 1.2;
                    $totalPrice = $diffDays * $newPrice;
                } elseif($formData['devise'] === "£") {
                    $newPrice = $logement["prix"] * 0.85;
                    $totalPrice = $diffDays * $newPrice;
                }

                // Données de réservation
                $reservationData = [
                    'dateDebut' => date('Y-m-d', $startDate),
                    'dateFin' => date('Y-m-d', $endDate),
                    'nbrPersonne' => $formData['nbr_personne'],
                    'prix' => $totalPrice, 
                    'devise' => $formData['devise'], 
                    'userId' => $userSession['id'],
                    'logementId' => $logement['id'],
                    'status' => 'newChange'
                ];
                
                // Insérer les données de réservation dans la base de données
                $this->reservationModel->insert($reservationData);

                // Mettre à jour la colonne reserver de la table logement à true
                $this->reservationModel->update($reservationId, ['status' => "change"]);

                // Rediriger l'utilisateur vers une page de confirmation
                return redirect()->to('/success');
            } else {
                // Passer les données du logement à la vue
                $data['reservation'] = $reservation;
                $data['logement'] = $logement;

                // Concaténer les vues du header, du contenu et du footer
        
                return $this->header . $this->navbar . view('components/reservationChange', $data) . $this->footer;
            }
        } else {
            // Rediriger vers la page d'erreur 404
            return $this->header . $this->navbar . view('errors/html/error_404') . $this->footer;
        }
    }

    public function cancelReservation($userId, $reservationId, $logementId)
    {
        $this->reservationModel->update($reservationId, ['status' => 'cancel']);
        $this->logementModel->update($logementId, ['reserver' => 0]);
        return redirect()->to('users/' . $userId);
    }

    public function cancelReservationMateriel($userId, $reservationId, $materielId)
    {
        $this->reservationMaterielModel->update($reservationId, ['status' => 'cancel']);
        $this->materielModel->update($materielId, ['reserver' => 0]);
        return redirect()->to('users/' . $userId);
    }
}