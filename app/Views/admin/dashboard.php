

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Dashboard Admin</h1>
        <a href="<?= site_url('admin/users'); ?>" class="btn btn-primary mb-4">Gérer les utilisateurs</a>

        <!-- Liste des réservations -->
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
                            <a href="<?= site_url('admin/reservations/cancel/' . $reservation['id']) ?>" class="btn btn-danger">Rejeter</a>

                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>