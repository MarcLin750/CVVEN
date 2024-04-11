
<div class="container" style="height: 60vh;">
    <div class="row">
        <div class="col">
            <div class="card mx-auto align-items-center" style="width: 80vw; margin-top: 8vh; padding-block: 6vh;">
                <h2 class="m-2">
                    Connexion :
                </h2>
                <form method="POST">
                    <div class="card-body">
                        <?php $errors = session()->getFlashdata('errors'); ?>
                        <?php if ($errors) : ?>
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    <?php foreach ($errors as $error) : ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <div class="mb-2">
                            <label for="exampleInputEmail1" class="form-label">Adresse mail :</label>
                            <input type="text" class="form-control" name="mail">
                        </div>
                        <div class="mb-2">
                            <label for="exampleInputPassword1" class="form-label">Mot de passe :</label>
                            <input type="password" class="form-control" name="mdp">
                        </div>
                        <p>Vous n'avez pas encore de compte ? <a href="<?= base_url('auth/register') ?>">Inscription</a></p>
                        <button type="submit" class="btn btn-primary">Se connecter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>