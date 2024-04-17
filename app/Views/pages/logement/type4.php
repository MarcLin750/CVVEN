<div class="container" style='margin-top: 28px;'>
    <div class="card">
        <div class="card-header">
            <h1>Chambre groupe (4 personnes)</h1>
            <p>Nombre de logement disponible: <?= $nbr_logement_type4 ?>/12.</p>
        </div>
        <div class="card-body">
            <div class="list-group list-group-flush" style="max-height: 400px; overflow-y: auto;">
                <?php foreach ($logements as $logement) : ?>
                    <a href="<?= site_url('logement/') . $logement['id'] ?>" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"><?= $logement['numLogement'] ?></h5>
                            <small><?= $logement['ville'] ?></small>
                        </div>
                        <p class="mb-1"><?= $logement['details'] ?></p>
                        <small class="text-muted">
                            <?= $logement['nbrChambre'] ?> chambres,
                            <?= $logement['nbrLit'] ?> lits,
                            <?= ($logement['balcon']) ? 'Balcon' : 'Pas de balcon' ?>
                        </small>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>