<?php
$userSession = session()->get('user');
$isLoggedIn = $userSession && array_key_exists('isLoggedIn', $userSession) && $userSession['isLoggedIn'];
if ($isLoggedIn): 
?>
    <div class="container d-flex justify-content-center align-items-center" style="height: 60vh">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title text-center">Réservation Effectuée!</h5>
                <p class="card-text text-center p-4">Votre réservation a été effectuée, veuiller attendre la confirmation de l'hôte.</p>
                <div class="text-center">
                    <a href="/users/<?= $userSession['id'] ?>" class="btn btn-primary">Aller au Profil</a>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="container d-flex justify-content-center align-items-center" style="height: 60vh">
        <div class="card shadow">
            <div class="card-body">
                <h2 class="card-title mb-4">Problème de connexion.</h2>
                <p class="card-text">Vous devez vous connecter pour accéder à cette page.</p>
                <a href="/auth/login" class="btn btn-primary">Se connecter</a>
            </div>
        </div>
    </div>
<?php endif; ?>