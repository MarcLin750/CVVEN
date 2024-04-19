<?php
include 'C:\xampp2023\htdocs\CVVEN\app\Views\pages\connect.php'; // Inclure le fichier de connexion à la base de données

// Récupération des utilisateurs
$query = "SELECT * FROM users";
$stmt = $db->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll();

// Code HTML pour afficher les données
?>
<table>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Email</th>
    </tr>
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?= $user['id'] ?></td>
        <td><?= $user['nom'] ?></td> <!-- Assurez-vous que votre base de données a une colonne 'nom' ou ajustez en conséquence -->
        <td><?= $user['mail'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>