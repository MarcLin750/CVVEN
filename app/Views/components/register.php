<div class="container" style="height: 60vh;">
    <div class="row">
        <div class="col">
            <div class="card mx-auto align-items-center" style="width: 80vw; margin-top: 2vh; padding-block: 1vh;">
                <h2 class="m-2">
                    Inscription :
                </h2>
                <form method="POST">
                    <div class="card-body">
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
                        <div class="mb-2">
                            <label class="form-label">Nom :</label>
                            <input class="form-control" name="nom" value="<?= old('nom') ?>">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Prénom :</label>
                            <input class="form-control" name="prenom" value="<?= old('prenom') ?>">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Adresse mail :</label>
                            <input type="mail" class="form-control" name="mail" value="<?= old('mail') ?>">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Mot de passe :</label>
                            <input type="password" class="form-control" name="mdp">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Confirmer le mot de passe :</label>
                            <input type="password" class="form-control" name="mdpConfirmed">
                        </div>
                        <p>Vous avez deja un compte ? <a href="<?= base_url('auth/login') ?>">Se connecter</a></p>
                        <button type="submit" class="btn btn-primary">S'inscrire</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>