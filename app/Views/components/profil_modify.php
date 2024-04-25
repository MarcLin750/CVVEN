<?php
$userSession = session()->get('user');
if (isset($userSession)):
?>
<div class="container d-flex justify-content-center align-items-center" style="height: 60vh">
    <div class="card shadow">
        <div class="card-body">
            <h1 class="mb-4">Modifier mon profil</h1>
            <form method="POST">
                <?php $errors = session()->getFlashdata('errors');
                if($errors) :?>
                   <div class="alert alert-danger" role="alert">
                       <ul>
                           <?php foreach ($errors as $error) : ?>
                               <li><?= esc($error) ?></li>
                           <?php endforeach; ?>
                       </ul>
                   </div>
                <?php endif; ?>
                <h5 class="form-title">Formulaire de modification:</h5>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="firstname">Nom: </span>
                    <input type="text" class="form-control" name="nom" value="<?= esc($userSession['nom']) ?>" aria-label="firstname">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="name">Prénom: </span>
                    <input type="text" class="form-control" name="prenom" value="<?= esc($userSession['prenom']) ?>" aria-label="name">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="mail">Email: </span>
                    <input type="email" class="form-control" name="mail" value="<?= esc($userSession['mail']) ?>" aria-label="mail">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="mdp">Mot de passe :</span>
                    <input type="password" class="form-control" name="mdp" aria-label="mdp">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Modifier</button>
            </form>
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
