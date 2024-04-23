<?php
$userSession = session()->get('user');
$isAdmin = isset($userSession) && array_key_exists('isAdmin', $userSession) && $userSession['isAdmin'];
if ($isAdmin): ?>
    <div class="container-fluid mt-5">
        <!-- <a href="/admin/register" class="btn btn-primary mb-4">Autre Page</a> -->
        <a href="/admin/users" class="btn btn-primary mb-4">All Users</a>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4 shadow">
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
                                        <div class="list-group-item list-group-item-action">
                                            <div class="d-flex w-100 justify-content-between">
                                                <div class="col-md-3">
                                                    <h5 class="mb-1">Logement ID : <?= $reservation['logementId'] ?></h5>
                                                    <p class="mb-1">User : <?= $reservation['user']->prenom ?></p>
                                                </div>
                                                <div class="col-md-3">
                                                    <p class="mb-1">Date de Début : <?= $reservation['dateDebut'] ?></p>
                                                    <p class="mb-1">Date de Fin : <?= $reservation['dateFin'] ?></p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="mb-1">Nombre de Personnes : <?= $reservation['nbrPersonne'] ?></p>
                                                    <p class="mb-1">Prix : <?= $reservation['prix'] ?></p>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="d-flex justify-content-end">
                                                        <a href="<?= site_url('admin/reservations/cancel/' . $reservation['id'] . '/' . $reservation['logementId']) ?>" class="btn btn-danger">Supprimer</a>
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
                <div class="card mb-4 shadow">
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
                                                <div class="col-md-3">
                                                    <h5 class="mb-1">Logement ID : <?= $reservation['logementId'] ?></h5>
                                                    <p class="mb-1">User : <?= $reservation['user']->prenom ?></p>
                                                </div>
                                                <div class="col-md-3">
                                                    <p class="mb-1">Date de Début : <?= $reservation['dateDebut'] ?></p>
                                                    <p class="mb-1">Date de Fin : <?= $reservation['dateFin'] ?></p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="mb-1">Nombre de Personnes : <?= $reservation['nbrPersonne'] ?></p>
                                                    <p class="mb-1">Prix : <?= $reservation['prix'] ?></p>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="rox">
                                                        <div class="col-md-12">
                                                            <a href="<?= site_url('admin/reservations/confirm/' . $reservation['id'] . '/' . $reservation['logementId']) ?>" class="btn btn-success mb-2">ReConfirmer</a>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <a href="<?= site_url('admin/reservations/delete/' . $reservation['id']) ?>" class="btn btn-danger mb-2">Supprimer</a>
                                                        </div>
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

            <div class="col-md-6">
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
                                                    <p class="mb-1">User : <?= $reservationMateriel['user']->prenom ?></p>
                                                </div>
                                                <div class="col-md-3">
                                                    <p class="mb-1">Date de Début : <?= $reservationMateriel['dateDebut'] ?></p>
                                                    <p class="mb-1">Date de Fin : <?= $reservationMateriel['dateFin'] ?></p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="mb-1">Materiel ID : <?= $reservationMateriel['materiel_id'] ?></p>
                                                    <p class="mb-1">Details : <?= $reservationMateriel['materielModel']['details'] ?></p>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="d-flex justify-content-end">
                                                        <a href="<?= site_url('admin/reservations/materiel/cancel/' . $reservationMateriel['id'] . '/' . $reservationMateriel['materiel_id']) ?>" class="btn btn-danger">Supprimer</a>
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
                <div class="card mb-4 shadow">
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
                                                <div class="col-md-3">
                                                    <h5 class="mb-1">Reservation ID : <?= $reservationMaterielCancel['id'] ?></h5>
                                                    <p class="mb-1">User : <?= $reservationMaterielCancel['user']->prenom ?></p>
                                                </div>
                                                <div class="col-md-3">
                                                    <p class="mb-1">Date de Début : <?= $reservationMaterielCancel['dateDebut'] ?></p>
                                                    <p class="mb-1">Date de Fin : <?= $reservationMaterielCancel['dateFin'] ?></p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="mb-1">Materiel ID : <?= $reservationMaterielCancel['materiel_id'] ?></p>
                                                    <p class="mb-1">Details : <?= $reservationMaterielCancel['materielModel']['details'] ?></p>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="rox">
                                                        <div class="col-md-12">
                                                            <a href="<?= site_url('admin/reservations/materiel/confirm/' . $reservationMaterielCancel['id'] . '/' . $reservationMaterielCancel['materiel_id']) ?>" class="btn btn-success mb-2">ReConfirmer</a>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <a href="<?= site_url('admin/reservations/materiel/delete/' . $reservationMaterielCancel['id']) ?>" class="btn btn-danger mb-2">Supprimer</a>
                                                        </div>
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
    <div class="card text-center">
        <div class="card-body">
            <h2 class="card-title mb-4">Vous n'avez pas les autorisations requises.</h2>
            <a href="/" class="btn btn-primary">Retourner à la page d'accueil.</a>
        </div>
    </div>
<?php endif; ?>