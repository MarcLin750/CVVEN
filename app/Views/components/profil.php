<div class="container mt-5">
    <div class="card shadow">
        <div class="card-body">
            <h1 class="mb-4">Profil Utilisateur</h1>
            <?php 
            $userSession = session()->get('user');
            if (isset($userSession)): 
            ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Informations de l'utilisateur</h5>
                        <p class="card-text">Nom: <?= $userSession['nom'] ?></p>
                        <p class="card-text">Prénom: <?= $userSession['prenom'] ?></p>
                        <p class="card-text">Email: <?= $userSession['mail'] ?></p>
                        <!-- Ajoutez d'autres informations de l'utilisateur si nécessaire -->
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-danger" role="alert">
                    Aucun utilisateur connecté.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
