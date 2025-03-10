<?php
include_once __DIR__ . '/../../includes/db.php';
include_once __DIR__ . '/../../includes/header.php';
$sql = "SELECT * FROM clients";
$stmt = $conn->query($sql);
$clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des clients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Liste des clients</h1>
        <a href="ajouter.php" class="btn btn-primary mb-3">Ajouter un client</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Entreprise</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clients as $client): ?>
                    <tr>
                        <td><?= $client['id'] ?></td>
                        <td><?= $client['nom'] ?></td>
                        <td><?= $client['prenom'] ?></td>
                        <td><?= $client['email'] ?></td>
                        <td><?= $client['entreprise'] ?></td>
                        <td>
                            <a href="modifier.php?id=<?= $client['id'] ?>" class="btn btn-warning">Modifier</a>
                            <a href="supprimer.php?id=<?= $client['id'] ?>" class="btn btn-danger">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>