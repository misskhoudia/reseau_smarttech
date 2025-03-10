<?php
include_once __DIR__ . '../includes/db.php';
include_once __DIR__ . '../includes/header.php';


// Récupérer le nombre total de clients
try {
    $stmt = $conn->query("SELECT COUNT(*) as total_clients FROM clients");
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $totalClients = $data['total_clients'];
} catch (PDOException $e) {
    $totalClients = "Erreur";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Projet Smarttech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Bienvenue sur Projet Smarttech</h1>
        <p class="text-center">Tableau de bord rapide</p>

        <div class="row">
            <!-- Carte des clients -->
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Clients</h5>
                        <p class="card-text">Nombre total : <strong><?= $totalClients ?></strong></p>
                        <a href="pages/clients/index.php" class="btn btn-light">Voir les clients</a>
                    </div>
                </div>
            </div>

            <!-- Ajouter d'autres cartes pour d'autres pages -->
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Ajouter un client</h5>
                        <p class="card-text">Ajoutez de nouveaux clients facilement.</p>
                        <a href="pages/clients/ajouter.php" class="btn btn-light">Ajouter un client</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Gérer les clients</h5>
                        <p class="card-text">Modifiez ou supprimez les clients existants.</p>
                        <a href="pages/clients/index.php" class="btn btn-light">Gérer les clients</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
