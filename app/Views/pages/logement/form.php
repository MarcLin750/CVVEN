<?php
$userSession = session()->get('user');
$isLoggedIn = $userSession && array_key_exists('isLoggedIn', $userSession) && $userSession['isLoggedIn'];
if ($isLoggedIn): ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                    <div class="card-body">
                        <h1 class="card-title text-center">Logement <?php echo $logement['id']; ?></h1>
                        <hr>
                        <p class="card-text">
                            Ce logement, situé au <?php echo $logement['etage']; ?>ème étage de l'aile <?php echo $logement['aile']; ?>, dans la ville de <?php echo $logement['ville']; ?>, est de catégorie <?php echo $logement['categorie']; ?>. Il dispose de <?php echo $logement['nbrChambre']; ?> chambres avec <?php echo $logement['nbrLit']; ?> lits et <?php echo $logement['balcon'] ? 'un balcon' : 'aucun balcon'; ?>. Voici les détails supplémentaires : <?php echo $logement['details']; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card shadow-lg mb-5 bg-white rounded">
                    <div class="card-body">
                        <h2 class="card-title text-center">Réserver ce logement</h2>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-4" id="reservation-card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center">Dates de réservation</h5>
                                        <hr>
                                        <form method="POST">
                                            <div class="input-group mb-3">
                                              <label class="input-group-text" for="start_date">Date de début:</label>
                                              <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>"  max="<?php echo date('Y-m-d', strtotime('+30 day')); ?>"required>
                                            </div>
                                            <div class="input-group mb-3">
                                              <label class="input-group-text" for="end_date">Date de fin:</label>
                                              <input type="date" class="form-control"  id="end_date" name="end_date" value="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" max="<?php echo date('Y-m-d', strtotime('+31 day')); ?>" required>
                                            </div>
                                            <div class="input-group mb-3">
                                              <label class="input-group-text" for="nbr_personne">Nombre de personnes:</label>
                                              <input type="number" class="form-control" id="nbr_personne" name="nbr_personne" min="1" max="<?php echo $logement["nbrLit"]; ?>" value="<?php echo $logement["nbrLit"]; ?>" required>
                                            </div>
                                            <div class="input-group mb-3">
                                                <label class="input-group-text" for="nbr_personne">Devise:</label>
                                                <select id="deviseSelect" class="form-control" name="devise">
                                                    <option value="€" <?php if ($logement["devise"] == "€") { echo "selected"; } ?>>€ - EUR</option>
                                                    <option value="$" <?php if ($logement["devise"] == "$") { echo "selected"; } ?>>$ - USD</option>
                                                    <option value="£" <?php if ($logement["devise"] == "£") { echo "selected"; } ?>>£ - GBP</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Réserver</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-4" id="price-card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center">Détails de la réservation</h5>
                                        <hr>
                                        <ul class="list-unstyled" id="price-list"></ul>
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

<script>
    // Fonction pour calculer le prix total en fonction des dates sélectionnées
    function calculateTotalPrice() {
        // Récupérer les éléments de formulaire
        var startDateInput = document.getElementById('start_date');
        var endDateInput = document.getElementById('end_date');
        var priceList = document.getElementById('price-list');
        var deviseSelect = document.getElementById('deviseSelect');

        // Vérifier si les deux dates ont été sélectionnées
        if (startDateInput.value && endDateInput.value) {
            // Calculer le nombre de nuits entre les dates sélectionnées
            var startDate = new Date(startDateInput.value);
            var endDate = new Date(endDateInput.value);
            var timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24) + 1);
            var diffNight = Math.ceil(timeDiff / (1000 * 3600 * 24));

            // Afficher les prix et le nombre de nuits dans la liste
            priceList.innerHTML = '';
            priceList.innerHTML += '<li><strong>Nombre de jours:</strong> ' + diffDays + '</li>';
            priceList.innerHTML += '<li><strong>Nombre de nuits:</strong> ' + diffNight + '</li>';
            priceList.innerHTML += '<li><strong>Prix par nuit:</strong> ' + (<?php echo $logement["prix"]; ?> * getExchangeRate(deviseSelect.value)).toFixed(2)+ deviseSelect.value + '</li>';
            priceList.innerHTML += '<li><strong>Prix total:</strong> ' + (diffNight * <?php echo $logement["prix"]; ?> * getExchangeRate(deviseSelect.value)).toFixed(2) + ' ' + deviseSelect.value + '</li>';
        }
    }

    // Fonction pour obtenir le taux de change pour une devise donnée
    function getExchangeRate(devise) {
        // Remplacez cette fonction par votre propre code pour obtenir le taux de change à partir d'une API ou d'une base de données
        switch (devise) {
            case "€":
                return 1;
            case "$":
                return 1.2;
            case "£":
                return 0.85;
        }
    }

    // Ajouter un écouteur d'événements pour calculer le prix total lorsqu'une date est sélectionnée
    document.getElementById('start_date').addEventListener('change', calculateTotalPrice);
    document.getElementById('end_date').addEventListener('change', calculateTotalPrice);

    // Ajouter un écouteur d'événements pour calculer le prix total lorsque la devise est sélectionnée
    document.getElementById('deviseSelect').addEventListener('change', calculateTotalPrice);

    // Calculer le prix total par défaut lors du chargement de la page
    calculateTotalPrice();
</script>
