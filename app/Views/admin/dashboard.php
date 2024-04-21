<div class="container mt-5">
    <!-- <a href="/admin/register" class="btn btn-primary mb-4">Autre Page</a> -->
    <div class="container">
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
                                <div class="d-flex w-100 justify-content-between">
                                    <div class="col-md-3">
                                        <h5 class="mb-1">Logement ID : <?= $reservation['id'] ?></h5>
                                        <?php if (isset($users[$reservation['userId']])) : ?>
                                            <p class="mb-1">User : <?= $users[$reservation['userId']]->prenom ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="mb-1">Date de Début : <?= $reservation['dateDebut'] ?></p>
                                        <p class="mb-1">Date de Fin : <?= $reservation['dateFin'] ?></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="mb-1">Nombre de Personnes : <?= $reservation['nbrPersonne'] ?></p>
                                        <p class="mb-1">Prix : <?= $reservation['prix'] ?></p>
                                    </div>
                                    <div class="col-md-3">
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

        <div class="card shadow">
            <div class="card-body">
                <h1 class="mb-4">Réservations Annulées</h1>
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
                                        <h5 class="mb-1">Logement ID : <?= $reservation['id'] ?></h5>
                                        <?php if (isset($users[$reservation['userId']])) : ?>
                                            <p class="mb-1">User : <?= $users[$reservation['userId']]->prenom ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="mb-1">Date de Début : <?= $reservation['dateDebut'] ?></p>
                                        <p class="mb-1">Date de Fin : <?= $reservation['dateFin'] ?></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="mb-1">Nombre de Personnes : <?= $reservation['nbrPersonne'] ?></p>
                                        <p class="mb-1">Prix : <?= $reservation['prix'] ?></p>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="d-flex justify-content-end">
                                            <a href="<?= site_url('admin/reservations/confirm/' . $reservation['id']. '/' . $reservation['logementId']) ?>" class="btn btn-success me-2">ReConfirmer</a>
                                            <!-- <a href="<?= site_url('admin/reservations/cancel/' . $reservation['id'] . '/' . $reservation['logementId']) ?>" class="btn btn-danger">Supprimer</a> -->
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