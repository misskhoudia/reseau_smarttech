<?php
include_once __DIR__ . '/../../includes/db.php';
include_once __DIR__ . '/../../includes/header.php';
$sql = "SELECT * FROM employes";
$stmt = $conn->query($sql);
$employes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des employés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Liste des employés</h1>
        <a href="ajouter.php" class="btn btn-primary mb-3">Ajouter un employé</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Poste</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employes as $employe): ?>
                    <tr>
                        <td><?= $employe['id'] ?></td>
                        <td><?= $employe['nom'] ?></td>
                        <td><?= $employe['prenom'] ?></td>
                        <td><?= $employe['email'] ?></td>
                        <td><?= $employe['poste'] ?></td>
                        <td>
                            <a href="modifier.php?id=<?= $employe['id'] ?>" class="btn btn-warning">Modifier</a>
                            <a href="supprimer.php?id=<?= $employe['id'] ?>" class="btn btn-danger">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>