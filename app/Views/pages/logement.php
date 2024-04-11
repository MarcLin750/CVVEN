

<h1>Les logements:</h1>

<?php foreach($logement as $logements): ?>
    <p><?php echo $logements["id"] ?></p>
    <p><?php echo $logements["details"] ?></p>
<?php endforeach; ?>