<h1>Dashboard Admin</h1>
<a href="<?= site_url('admin/users'); ?>">Gérer les utilisateurs</a>
<!-- Liste des réservations(se) -->
<table>
    <tr>
        <th>ID</th>
        <th>Utilisateur</th>
        <th>Logement</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    <?php if (isset($reservations) && !empty($reservations)): ?>
        <?php foreach ($reservations as $reservation): ?>
        <tr>
            <td><?= esc($reservation['id']) ?></td>
            <td><?= esc($reservation['nom']) ?> <?= esc($reservation['prenom']) ?></td>
            <td><?= esc($reservation['logement_nom']) ?></td>
            <td><?= esc($reservation['status']) ?></td>
            <td>
                <a href="<?= site_url('admin/reservations/confirm/' . $reservation['id']) ?>">Confirmer</a>
                <a href="<?= site_url('admin/reservations/cancel/' . $reservation['id']) ?>">Annuler</a>
                <?php "Coucou "; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">Aucune réservation trouvée.</td>
        </tr>
    <?php endif; ?>
</table>