<?php
$userSession = session()->get('user');
$isLoggedIn = $userSession && array_key_exists('isLoggedIn', $userSession) && $userSession['isLoggedIn'];

if ($isLoggedIn): ?>
    <div class="container" style='margin-top: 28px;'>
        <div class="card">
            <div class="card-header">
                <h1>Internet</h1>
                <p>Nombre de matériels disponible: <?= $nbr_materiel_type3 ?>/7.</p>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush" style="max-height: 400px; overflow-y: auto;">
                    <?php foreach ($materiels as $materiel) : ?>
                        <a href="<?= $materiel['id'] ?>" class="list-group-item list-group-item-action">
                            <p class="mb-1"><?= $materiel['details'] ?></p>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="container d-flex justify-content-center align-items-center" style="height: 60vh">
        <div class="card shadow">
            <div class="card-body">
                <h2 class="card-title mb-4">Vous n'êtes pas connecté</h2>
                <p class="card-text">Vous devez vous connecter pour accéder à cette page.</p>
                <a href="/auth/login" class="btn btn-primary">Se connecter</a>
            </div>
        </div>
    </div>
<?php endif; ?>