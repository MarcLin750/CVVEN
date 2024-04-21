<div class="container mt-5">
    <div class="row">
        <div class="col">
            <div class="card mx-auto" style="width: 80vw;">
                <h2 class="card-header text-center">Connexion</h2>
                <div class="card-body">
                    <form method="POST">
                        <?php $errors = session()->getFlashdata('errors'); ?>
                        <?php if ($errors) : ?>
                            <div class="alert alert-danger" role="alert">
                                <ul class="list-unstyled mb-0">
                                    <?php foreach ($errors as $error) : ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Adresse mail :</label>
                            <input type="text" class="form-control" name="mail">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Mot de passe :</label>
                            <input type="password" class="form-control" name="mdp">
                        </div>
                        <p class="mb-3 text-center">Vous n'avez pas encore de compte ? <a href="<?= base_url('auth/register') ?>">Inscription</a></p>
                        <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
