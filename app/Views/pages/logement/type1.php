<?php
$userSession = session()->get('user');
$isLoggedIn = $userSession && array_key_exists('isLoggedIn', $userSession) && $userSession['isLoggedIn'];

if ($isLoggedIn): ?>
    <div class="container" style='margin-top: 28px;'>
        <div class="card">
            <div class="card-header">
                <h1>Logement familial</h1>
                <p>Nombre de logement disponible: <?= $nbr_logement_type1 ?>/40.</p>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush" style="max-height: 400px; overflow-y: auto;">
                    <?php foreach ($logements as $logement) : ?>
                        <a href="<?= $logement['id'] ?>" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><?= $logement['id'] ?></h5>
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
<?php else: ?>
    <div class="card text-center">
    <div class="card-body">
        <h2 class="card-title mb-4">Vous n'êtes pas connecté</h2>
        <p class="card-text">Vous devez vous connecter pour accéder à cette page.</p>
        <a href="/auth/login" class="btn btn-primary">Se connecter</a>
    </div>
    </div>
<?php endif; ?>
