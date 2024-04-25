<?php
$userSession = session()->get('user');
if (isset($userSession)):
?>
    <div class="container d-flex justify-content-center align-items-center" style="height: 60vh">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title text-center">Modification Effectuée!</h5>
                <p class="card-text text-center p-4">Vous allez être automatiquement déconnecté pour mettre à jour vos informations.</p>
                <div class="text-center">
                    <a href="/auth/login" class="btn btn-primary">Se reconnecter</a>
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
