<div class="container mt-5">
    <div class="card shadow" style="height: 80vh;">
        <div class="card-body">
            <h1 class="mb-4">Liste des Utilisateurs</h1>
            <a href="/admin/dashboard" class="btn btn-primary mb-3">Retour au Dashboard</a>
            <?php if (empty($users)) : ?>
                <div class="alert alert-info" role="alert">
                    Aucun utilisateur trouvé.
                </div>
            <?php else : ?>
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user->id ?></td>
                            <td><?= $user->nom ?></td>
                            <td><?= $user->mail ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>