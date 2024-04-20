<?php
include 'C:\xampp2023\htdocs\CVVEN\app\Views\pages\connect.php'; // Inclure le fichier de connexion à la base de données

// Récupération des utilisateurs
$query = "SELECT * FROM users";
$stmt = $db->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll();

// Code HTML pour afficher les données
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Utilisateurs</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Liste des Utilisateurs</h1>
        <table class="table table-bordered mt-4">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['nom'] ?></td> <!-- Assurez-vous que votre base de données a une colonne 'nom' ou ajustez en conséquence -->
                    <td><?= $user['mail'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>