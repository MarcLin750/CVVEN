<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
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
        <div class="col-md-6">
            <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                <div class="card-body">
                    <h2 class="card-title text-center">Réserver ce logement</h2>
                    <hr>
                    <form action="/reservation" method="POST">
                        <div class="form-group">
                            <label for="start_date">Date de début:</label>
                            <input type="date" id="start_date" name="start_date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="end_date">Date de fin:</label>
                            <input type="date" id="end_date" name="end_date" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Réserver</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            // Configuration du calendrier
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            defaultDate: '<?php echo date("Y-m-d"); ?>',
            editable: false,
            eventLimit: true,
            events: [
                <?php
                // Remplacez cette requête par celle qui récupère les réservations existantes pour ce logement
                $events = [];
                foreach ($events as $event) {
                    echo "{
                        title: 'Réservé',
                        start: '" . $event['start_date'] . "',
                        end: '" . $event['end_date'] . "'
                    },";
                }
                ?>
            ]
        });
    });
</script>
