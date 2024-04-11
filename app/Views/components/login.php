<div class='container'>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Connexion</label>
        </div>
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
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Adresse mail</label>
            <input type="text" class="form-control" name="email">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" name="password">
        </div>
        <p>Vous n'avez pas encore de compte ? <a href="<?= base_url('auth/register') ?>">Inscription</a></p>
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
</div>