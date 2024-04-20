<div class="container mt-5">
    <div class="card shadow" style="height: 80vh;">
        <div class="card-body">
            <h1 class="mb-4">Dashboard Admin</h1>
            <a href="<?= site_url('admin/users'); ?>" class="btn btn-primary mb-4">Gérer les utilisateurs</a>
            <!-- Liste des réservations -->
            <?php if (empty($reservations)) : ?>
                <div class="alert alert-info" role="alert">
                    Aucune réservation disponible.
                </div>
            <?php else : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Date de Début</th>
                                <th>Date de Fin</th>
                                <th>Nombre de Personnes</th>
                                <th>Prix</th>
                                <th>ID Utilisateur</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reservations as $reservation): ?>
                            <tr>
                                <td><?= $reservation['id'] ?></td>
                                <td><?= $reservation['dateDebut'] ?></td>
                                <td><?= $reservation['dateFin'] ?></td>
                                <td><?= $reservation['nbrPersonne'] ?></td>
                                <td><?= $reservation['prix'] ?></td>
                                <td><?= $reservation['userId'] ?></td>
                                <td>
                                    <a href="<?= site_url('admin/reservations/confirm/' . $reservation['id']) ?>" class="btn btn-success">Confirmer</a>
                                    <a href="<?= site_url('admin/reservations/cancel/' . $reservation['logementId']) ?>" class="btn btn-danger">Rejeter</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
