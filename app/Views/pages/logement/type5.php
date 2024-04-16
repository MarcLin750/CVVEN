<h1>Logement liste type 5</h1>

<p>Nombre de logement disponible: <?= $nbr_logement_type5 ?>/1.</p>

<table>
    <thead>
        <tr>
            <th>Numéro de logement</th>
            <th>Étage</th>
            <th>Aile</th>
            <th>Ville</th>
            <th>Catégorie</th>
            <th>Détails</th>
            <th>Nombre de chambres</th>
            <th>Nombre de lits</th>
            <th>Balcon</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($logements as $logement) : ?>
            <tr>
                <td><?= $logement['numLogement'] ?></td>
                <td><?= $logement['etage'] ?></td>
                <td><?= $logement['aile'] ?></td>
                <td><?= $logement['ville'] ?></td>
                <td><?= $logement['categorie'] ?></td>
                <td><?= $logement['details'] ?></td>
                <td><?= $logement['nbrChambre'] ?></td>
                <td><?= $logement['nbrLit'] ?></td>
                <td><?= $logement['balcon'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>