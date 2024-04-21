<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title text-center">Réservation Effectuée!</h5>
                    <p class="card-text text-center"></p>  
                    <?php
                    $userSession = session()->get('user');
                    $isAdmin = isset($userSession) && array_key_exists('isAdmin', $userSession) && $userSession['isAdmin'];
                    $isLoggedIn = $userSession && array_key_exists('isLoggedIn', $userSession) && $userSession['isLoggedIn'];
                    if ($isLoggedIn): ?>
                    <div class="text-center">
                        <a href="/users/<?= $userSession['id'] ?>" class="btn btn-primary">Aller au Profil</a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
