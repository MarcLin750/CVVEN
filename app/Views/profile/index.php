

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>
    <?php if (!empty($user)): ?>
        <h1>Welcome, <?= htmlspecialchars($user['nom']); ?></h1>
        <p>Email: <?= htmlspecialchars($user['mail']); ?></p>
        <h2>Your Reservations</h2>
        <?php if (!empty($reservations)): ?>
            <ul>
                <?php foreach ($reservations as $reservation): ?>
                    <li>
                        From: <?= htmlspecialchars($reservation['dateDebut']); ?>
                        to <?= htmlspecialchars($reservation['dateFin']); ?>,
                        Total People: <?= htmlspecialchars($reservation['nbrPersonne']); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No reservations found.</p>
        <?php endif; ?>
    <?php else: ?>
        <h1>User not found.</h1>
    <?php endif; ?>
</body>
</html>
