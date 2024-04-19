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
                                    <form action="/reservation" method="POST">
                                        <div class="input-group mb-3">
                                          <label class="input-group-text" for="start_date">Date de début:</label>
                                          <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo date('Y-m-d'); ?>" required>
                                        </div>
                                        <div class="input-group mb-3">
                                          <label class="input-group-text" for="end_date">Date de fin:</label>
                                          <input type="date" class="form-control"  id="end_date" name="end_date" value="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" required>
                                        </div>
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
                    <button type="submit" class="btn btn-primary" formtarget="_parent">Réserver</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Fonction pour calculer le prix total en fonction des dates sélectionnées
    function calculateTotalPrice() {
        // Récupérer les éléments de formulaire
        var startDateInput = document.getElementById('start_date');
        var endDateInput = document.getElementById('end_date');
        var priceList = document.getElementById('price-list');

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
            priceList.innerHTML += '<li><strong>Prix par nuit:</strong> <?php echo $logement["prix"]; ?> euros</li>';
            priceList.innerHTML += '<li><strong>Prix total:</strong> ' + (diffNight * <?php echo $logement["prix"]; ?>).toFixed(2) + ' euros</li>';
        }
    }

    // Ajouter un écouteur d'événements pour calculer le prix total lorsqu'une date est sélectionnée
    document.getElementById('start_date').addEventListener('change', calculateTotalPrice);
    document.getElementById('end_date').addEventListener('change', calculateTotalPrice);

    // Calculer le prix total par défaut lors du chargement de la page
    calculateTotalPrice();
</script>


<script>
    // Fonction pour calculer le prix total en fonction des dates sélectionnées
    function calculateTotalPrice() {
        // Récupérer les éléments de formulaire
        var startDateInput = document.getElementById('start_date');
        var endDateInput = document.getElementById('end_date');
        var priceList = document.getElementById('price-list');

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
            priceList.innerHTML += '<li><strong>Prix par nuit:</strong> <?php echo $logement["prix"]; ?> euros</li>';
            priceList.innerHTML += '<li><strong>Prix total:</strong> ' + (diffNight * <?php echo $logement["prix"]; ?>).toFixed(2) + ' euros</li>';
        }
    }

    // Ajouter un écouteur d'événements pour calculer le prix total lorsqu'une date est sélectionnée
    document.getElementById('start_date').addEventListener('change', calculateTotalPrice);
    document.getElementById('end_date').addEventListener('change', calculateTotalPrice);

    // Calculer le prix total par défaut lors du chargement de la page
    calculateTotalPrice();
</script>
