<?php
$userSession = session()->get('user');
$isLoggedIn = $userSession && array_key_exists('isLoggedIn', $userSession) && $userSession['isLoggedIn'];
if ($isLoggedIn): ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                    <div class="card-body">
                        <h1 class="card-title text-center">Materiel <?php echo $materiel['categorie']; ?></h1>
                        <hr>
                        <p class="card-text">
                            <?php echo $materiel['details']; ?>
                        </p>
                    </div>
                </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-lg mb-5 bg-white rounded">
                    <div class="card-body">
                        <h2 class="card-title text-center">Réserver ce matériel</h2>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="card mb-4" id="reservation-card">
                                    <div class="card-body">
                                        <form method="POST" action="/materiel/reserve/<?php echo $materiel['id']; ?>">
                                            <div class="mb-3">
                                                <label for="start_date" class="form-label">Date de début:</label>
                                                <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="end_date" class="form-label">Date de fin:</label>
                                                <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo date('Y-m-d', strtotime('+1 day')); ?>"  min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Réserver</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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