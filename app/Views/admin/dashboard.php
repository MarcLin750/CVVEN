<?php
$userSession = session()->get('user');
$isAdmin = isset($userSession) && array_key_exists('isAdmin', $userSession) && $userSession['isAdmin'];
if ($isAdmin): ?>
    <div class="container mt-5">
    <!-- <a href="/admin/register" class="btn btn-primary mb-4">Autre Page</a> -->
    <a href="/admin/users" class="btn btn-primary mb-4">All Users</a>
        <div class="card p-4 mb-4 shadow">
            <div class="card mb-4">
                <div class="card-body">
                    <h1 class="mb-4">Réservations de logements</h1>
                    <div class="list-group list-group-flush" style="max-height: 400px; overflow-y: auto;">
                        <?php if (empty($reservations)) : ?>
                            <div class="alert alert-info" role="alert">
                                Aucune réservation confirmée disponible.
                            </div>
                        <?php else : ?>
                            <div class="list-group list-group-flush" style="max-height: 400px; overflow-y: auto;">
                                <?php foreach ($reservations as $reservation): ?>
                                    <div class="list-group-item list-group-item-action border">
                                        <div class="d-flex w-100 justify-content-between">
                                            <div class="col-md-2">
                                                <h5 class="mb-1">Logement : <?= $reservation['logementId'] ?></h5>
                                                <p class="mb-1">User : <?= $reservation['user']->prenom ?></p>
                                            </div>
                                            <div class="col-md-3">
                                                <?php if ($reservation['status'] === 'validate'):?>
                                                    <h5><span class="badge text-bg-success">Réservation<br>confirmer</span></h5>
                                                <?php endif;?>
                                                <?php if ($reservation['status'] === 'wait'):?>
                                                    <h5><span class="badge text-bg-warning">En attente<br>de confirmation</span></h5>
                                                <?php endif;?>
                                                <?php if ($reservation['status'] === 'newChange'):?>
                                                    <h5><span class="badge text-bg-warning">En attente de confirmation<br>(Réservation modifier)</span></h5>
                                                <?php endif;?>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="mb-1">Date de Début : <?= $reservation['dateDebut'] ?></p>
                                                <p class="mb-1">Date de Fin : <?= $reservation['dateFin'] ?></p>
                                            </div>
                                            <div class="col-md-2">
                                                <p class="mb-1">Nombre de Personnes : <?= $reservation['nbrPersonne'] ?></p>
                                                <p class="mb-1">Prix : <?= $reservation['prix'] . $reservation['devise'] ?></p>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="d-flex justify-content-end">
                                                    <a href="<?= site_url('admin/reservations/validate/' . $reservation['id']) ?>" class="btn btn-success me-2">Confirmer</a>
                                                    <a href="<?= site_url('admin/reservations/refuse/' . $reservation['id'] . '/' . $reservation['logementId']) ?>" class="btn btn-danger me-2">Refuser</a>
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
            <div class="card">
                <div class="card-body">
                    <h1 class="mb-4">Réservations de logements annulées</h1>
                    <div class="list-group list-group-flush" style="max-height: 400px; overflow-y: auto;">
                        <?php if (empty($reservationsCancel)) : ?>
                            <div class="alert alert-info" role="alert">
                                Aucune réservation annulée disponible.
                            </div>
                        <?php else : ?>
                            <div class="list-group list-group-flush" style="max-height: 400px; overflow-y: auto;">
                                <?php foreach ($reservationsCancel as $reservation): ?>
                                    <div class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                            <div class="col-md-2">
                                                <h5 class="mb-1">Logement ID : <?= $reservation['logementId'] ?></h5>
                                                <p class="mb-1">User : <?= $reservation['user']->prenom ?></p>
                                            </div>
                                            <div class="col-md-2">
                                                <?php if ($reservation['status'] === 'refuse'):?>
                                                    <h5><span class="badge text-bg-danger">Réservation<br>refuser</span></h5>
                                                <?php endif;?>
                                                <?php if ($reservation['status'] === 'cancel'):?>
                                                    <h5><span class="badge text-bg-danger">Le client a annulé<br>la réservation</span></h5>
                                                <?php endif;?>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="mb-1">Date de Début : <?= $reservation['dateDebut'] ?></p>
                                                <p class="mb-1">Date de Fin : <?= $reservation['dateFin'] ?></p>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="mb-1">Nombre de Personnes : <?= $reservation['nbrPersonne'] ?></p>
                                                <p class="mb-1">Prix : <?= $reservation['prix'] ?></p>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="d-flex justify-content-end">
                                                    <a href="<?= site_url('admin/reservations/goback/' . $reservation['id'] . '/' . $reservation['logementId']) ?>" class="btn btn-success me-2">Annuler</a>
                                                    <a href="<?= site_url('admin/reservations/delete/' . $reservation['id']) ?>" class="btn btn-danger">Supprimer</a>
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

        <div class="card p-4 mb-4 shadow">
            <div class="card mb-4">
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
                                            <div class="col-md-2">
                                                <h5 class="mb-1">Reservation ID : <?= $reservationMateriel['id'] ?></h5>
                                                <p class="mb-1">User : <?= $reservationMateriel['user']->prenom ?></p>
                                            </div>
                                            <div class="col-md-3">
                                                <?php if ($reservationMateriel['status'] === 'validate'):?>
                                                    <h5><span class="badge text-bg-success">Réservation<br>confirmer</span></h5>
                                                <?php endif;?>
                                                <?php if ($reservationMateriel['status'] === 'wait'):?>
                                                    <h5><span class="badge text-bg-warning">En attente<br>de confirmation</span></h5>
                                                <?php endif;?>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="mb-1">Date de Début : <?= $reservationMateriel['dateDebut'] ?></p>
                                                <p class="mb-1">Date de Fin : <?= $reservationMateriel['dateFin'] ?></p>
                                            </div>
                                            <div class="col-md-2">
                                                <p class="mb-1">Materiel ID : <?= $reservationMateriel['materiel_id'] ?></p>
                                                <p class="mb-1">Details : <?= $reservationMateriel['materielModel']['details'] ?></p>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="d-flex justify-content-end">
                                                    <a href="<?= site_url('admin/reservations/materiel/validate/' . $reservationMateriel['id']) ?>" class="btn btn-success me-2">Confirmer</a>
                                                    <a href="<?= site_url('admin/reservations/materiel/refuse/' . $reservationMateriel['id'] . '/' . $reservationMateriel['materiel_id']) ?>" class="btn btn-danger me-2">Refuser</a>
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
            <div class="card">
                <div class="card-body">
                    <h1 class="mb-4">Réservations de matériel annulées</h1>
                    <div class="list-group list-group-flush" style="max-height: 400px; overflow-y: auto;">
                        <?php if (empty($reservationMaterielCancels)) : ?>
                            <div class="alert alert-info" role="alert">
                                Aucune réservation de matériel annulée disponible.
                            </div>
                        <?php else : ?>
                            <div class="list-group list-group-flush" style="max-height: 400px; overflow-y: auto;">
                                <?php foreach ($reservationMaterielCancels as $reservationMaterielCancel): ?>
                                    <div class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                            <div class="col-md-2">
                                                <h5 class="mb-1">Reservation ID : <?= $reservationMaterielCancel['id'] ?></h5>
                                                <p class="mb-1">User : <?= $reservationMaterielCancel['user']->prenom ?></p>
                                            </div>
                                            <div class="col-md-2">
                                                <?php if ($reservationMaterielCancel['status'] === 'refuse'):?>
                                                    <h5><span class="badge text-bg-danger">Réservation<br>refuser</span></h5>
                                                <?php endif;?>
                                                <?php if ($reservationMaterielCancel['status'] === 'cancel'):?>
                                                    <h5><span class="badge text-bg-danger">Le client a annulé<br>la réservation</span></h5>
                                                <?php endif;?>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="mb-1">Date de Début : <?= $reservationMaterielCancel['dateDebut'] ?></p>
                                                <p class="mb-1">Date de Fin : <?= $reservationMaterielCancel['dateFin'] ?></p>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="mb-1">Materiel ID : <?= $reservationMaterielCancel['materiel_id'] ?></p>
                                                <p class="mb-1">Details : <?= $reservationMaterielCancel['materielModel']['details'] ?></p>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="d-flex justify-content-end">
                                                    <a href="<?= site_url('admin/reservations/materiel/goback/' . $reservationMaterielCancel['id'] . '/' . $reservationMaterielCancel['materiel_id']) ?>" class="btn btn-success me-2">Retour</a>
                                                    <a href="<?= site_url('admin/reservations/materiel/delete/' . $reservationMaterielCancel['id']) ?>" class="btn btn-danger">Supprimer</a>
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
<?php else: ?>
    <div class="card text-center">
        <div class="card-body">
            <h2 class="card-title mb-4">Vous n'avez pas les autorisations requises.</h2>
            <a href="/" class="btn btn-primary">Retourner à la page d'accueil.</a>
        </div>
    </div>
<?php endif; ?>