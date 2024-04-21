<div class="container mt-5">
    <div class="row">
        <div class="col">
            <div class="card mx-auto" style="width: 80vw;">
                <h2 class="card-header text-center">Inscription</h2>
                <div class="card-body">
                    <form method="POST">
                        <?php $errors = session()->getFlashdata('errors');?>
                        <?php if($errors) :?>
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    <?php foreach ($errors as $error) : ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom :</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="<?= old('nom') ?>">
                        </div>
                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom :</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" value="<?= old('prenom') ?>">
                        </div>
                        <div class="mb-3">
                            <label for="mail" class="form-label">Adresse mail :</label>
                            <input type="email" class="form-control" id="mail" name="mail" value="<?= old('mail') ?>">
                        </div>
                        <div class="mb-3">
                            <label for="mdp" class="form-label">Mot de passe :</label>
                            <input type="password" class="form-control" id="mdp" name="mdp">
                        </div>
                        <div class="mb-3">
                            <label for="mdpConfirmed" class="form-label">Confirmer le mot de passe :</label>
                            <input type="password" class="form-control" id="mdpConfirmed" name="mdpConfirmed">
                        </div>
                        <p class="text-center">Vous avez déjà un compte ? <a href="<?= base_url('auth/login') ?>">Se connecter</a></p>
                        <button type="submit" class="btn btn-primary btn-block">S'inscrire</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
