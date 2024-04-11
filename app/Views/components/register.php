<div class='container'>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Inscription</label>
        </div>
        
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
            <label class="form-label">Nom</label>
            <input  class="form-control" name="last_name" value="<?= old('last_name') ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Prénom</label>
            <input  class="form-control" name="first_name" value="<?= old('first_name') ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Adresse mail</label>
            <input type="email" class="form-control" name="email" value="<?= old('email') ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Mot de passe</label>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="mb-3">
            <label class="form-label">Confirmer le mot de passe</label>
            <input type="password" class="form-control" name="passwordConfirm">
        </div>
        <p>Vous avez deja un compte ? <a href="<?= base_url('auth/login') ?>">Se connecter</a></p>
        <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>
</div>