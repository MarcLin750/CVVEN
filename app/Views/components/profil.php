<?php
$userSession = session()->get('user');
if (isset($userSession)):
?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h1 class="mb-4">Profil Utilisateur</h1>
                        <h5 class="card-title">Informations de l'utilisateur</h5>
                        <p class="card-text">Nom: <?= $userSession['nom'] ?></p>
                        <p class="card-text">Prénom: <?= $userSession['prenom'] ?></p>
                        <p class="card-text">Email: <?= $userSession['mail'] ?></p>
                        <!-- Ajoutez d'autres informations de l'utilisateur si nécessaire -->
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h1 class="mb-4">Réservations Confirmées</h1>
                        <?php if (empty($reservations)) : ?>
                            <div class="alert alert-info" role="alert">
                                Aucune réservation confirmée disponible.
                            </div>
                        <?php else : ?>
                            <div class="list-group list-group-flush" style="max-height: 400px; overflow-y: auto;">
                                <?php foreach ($reservations as $reservation): ?>
                                    <div class="list-group-item list-group-item-action">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h5 class="mb-1">Logement : <?= $reservation['logementId'] ?></h5>
                                                <h6 class="mb-1">Client : <?= $userSession['nom'] ?> <?= $userSession['prenom'] ?></h6>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1">Date de Début : <?= $reservation['dateDebut'] ?></p>
                                                <p class="mb-1">Date de Fin : <?= $reservation['dateFin'] ?></p>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="mb-1">Nombre de Personnes : <?= $reservation['nbrPersonne'] ?></p>
                                                <p class="mb-1">Prix : <?= $reservation['prix'] ?></p>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="d-flex justify-content-end">
                                                    <a href="<?= site_url('users/' . $userSession['id'] .'/'.'cancel/' . $reservation['id'] . '/' . $reservation['logementId']) ?>" class="btn btn-danger">Supprimer</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">

            </div>
            <div class="col-md-8">
                <div class="card mb-4 shadow">
                    <div class="card-body">
                        <h1 class="mb-4">Réservations de matériel</h1>
                        <div class="list-group list-group-flush" style="max-height: 400px; overflow-y: auto;">
                            <?php if (empty($reservationMateriels)) : ?>
                                <div class="alert alert-info" role="alert">
                                    Aucune réservation de materiel disponible.
                                </div>
                            <?php else : ?>
                                <div class="list-group list-group-flush" style="max-height: 400px; overflow-y: auto;">
                                    <?php foreach ($reservationMateriels as $reservationMateriel): ?>
                                        <div class="list-group-item list-group-item-action">
                                            <div class="d-flex w-100 justify-content-between">
                                                <div class="col-md-3">
                                                    <h5 class="mb-1">Reservation ID : <?= $reservationMateriel['id'] ?></h5>
                                                    <p class="mb-1">Client : <?= $userSession['nom'] ?> <?= $userSession['prenom'] ?></p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="mb-1">Date de Début : <?= $reservationMateriel['dateDebut'] ?></p>
                                                    <p class="mb-1">Date de Fin : <?= $reservationMateriel['dateFin'] ?></p>
                                                </div>
                                                <div class="col-md-3">
                                                    <p class="mb-1">Materiel ID : <?= $reservationMateriel['materiel_id'] ?></p>
                                                    <p class="mb-1">Details : <?= $reservationMateriel['materielModel']['details'] ?></p>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="d-flex justify-content-end">
                                                    <a href="<?= site_url('users/' . $userSession['id'] .'/materiel' . '/' . 'cancel/' . $reservationMateriel['id'] . '/' . $reservationMateriel['materiel_id']) ?>" class="btn btn-danger">Supprimer</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
<div class="alert alert-danger" role="alert">
    Aucun utilisateur connecté.
</div>
<?php endif; ?>
