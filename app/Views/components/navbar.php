<nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="/">CVVEN MKSL</a>
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active me-2" aria-current="page" href="/">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="/logement/">Logement</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="/materiel/">Matériel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="#">Salle de colloque</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="/contact/">Contact</a>
                </li>
            </ul>
            <div class="d-flex">
                <?php
                $userSession = session()->get('user');
                $isAdmin = isset($userSession) && array_key_exists('isAdmin', $userSession) && $userSession['isAdmin'];
                $isLoggedIn = $userSession && array_key_exists('isLoggedIn', $userSession) && $userSession['isLoggedIn'];
                if ($isLoggedIn): ?>
                    <span class="navbar-text me-3">
                        Bonjour, <?= $userSession['prenom'] ?>
                    </span>
                    <?php if ($isAdmin): ?>
                        <a href="<?= site_url('admin/dashboard'); ?>" class="btn btn-secondary btn-info me-2">Admin Panel</a>
                    <?php endif; ?>
                    <a href="/users/<?= $userSession['id'] ?>">
                        <button type="button" class="btn btn-success shadow-none me-2">
                            Profil
                        </button>
                    </a>
                    <a href="/auth/logout">
                        <button type="button" class="btn btn-danger shadow-none">
                            Déconnexion
                        </button>
                    </a>
                <?php else: ?>
                    <a href="/auth/login">
                        <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2">
                            Connexion
                        </button>
                    </a>
                    <a href="/auth/register">
                        <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2">
                            S'incrire
                        </button>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>