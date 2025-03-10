<?php
include_once __DIR__ . '/../../includes/db.php';
include_once __DIR__ . '/../../includes/header.php';

$sql = "SELECT * FROM documents";
$stmt = $conn->query($sql);
$documents = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des documents</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Liste des documents</h1>
        <a href="ajouter.php" class="btn btn-primary mb-3">Ajouter un document</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom du fichier</th>
                    <th>Chemin du fichier</th>
                    <th>Date d'upload</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($documents as $document): ?>
                    <tr>
                        <td><?= $document['id'] ?></td>
                        <td><?= $document['nom_fichier'] ?></td>
                        <td><?= $document['chemin_fichier'] ?></td>
                        <td><?= $document['date_upload'] ?></td>
                        <td>
                            <a href="modifier.php?id=<?= $document['id'] ?>" class="btn btn-warning">Modifier</a>
                            <a href="supprimer.php?id=<?= $document['id'] ?>" class="btn btn-danger">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>