<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header("Location: connexion.php");
    exit;
}

// Vérifier si l'utilisateur est un admin
if ($_SESSION['role'] !== 'admin') {
    echo "Accès refusé. Vous n'avez pas les permissions nécessaires.";
    exit;
}

// Connexion à la base de données
include_once __DIR__ . '/includes/db.php';

// Récupérer le nombre total de clients
try {
    $stmt = $conn->query("SELECT COUNT(*) as total_clients FROM clients");
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $totalClients = $data['total_clients'];
} catch (PDOException $e) {
    error_log("Erreur lors de la récupération du nombre de clients : " . $e->getMessage());
    $totalClients = "Erreur";
}

// Récupérer le nombre total d'employés
try {
    $stmt = $conn->query("SELECT COUNT(*) as total_employes FROM utilisateurs");
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $totalEmployes = $data['total_employes'];
} catch (PDOException $e) {
    error_log("Erreur lors de la récupération du nombre d'employés : " . $e->getMessage());
    $totalEmployes = "Erreur";
}

// Récupérer le nombre total de documents
try {
    $stmt = $conn->query("SELECT COUNT(*) as total_documents FROM documents");
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $totalDocuments = $data['total_documents'];
} catch (PDOException $e) {
    error_log("Erreur lors de la récupération du nombre de documents : " . $e->getMessage());
    $totalDocuments = "Erreur";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Projet Smarttech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <?php include_once __DIR__ . '/includes/header.php'; ?>

    <div class="container mt-5">
        <h1 class="text-center">Bienvenue sur Projet Smarttech</h1>
        <p class="text-center">Tableau de bord rapide</p>

        <div class="row">
            <!-- Carte des clients -->
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Clients</h5>
                        <p class="card-text">Nombre total : <strong><?= htmlspecialchars($totalClients) ?></strong></p>
                        <a href="pages/clients/index.php" class="btn btn-light">Voir les clients</a>
                    </div>
                </div>
            </div>

            <!-- Carte des employés -->
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Employés</h5>
                        <p class="card-text">Nombre total : <strong><?= htmlspecialchars($totalEmployes) ?></strong></p>
                        <a href="pages/employes/index.php" class="btn btn-light">Voir les employés</a>
                    </div>
                </div>
            </div>

            <!-- Carte des documents -->
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Documents</h5>
                        <p class="card-text">Nombre total : <strong><?= htmlspecialchars($totalDocuments) ?></strong></p>
                        <a href="pages/documents/index.php" class="btn btn-light">Voir les documents</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Autres fonctionnalités -->
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Ajouter un client</h5>
                        <p class="card-text">Ajoutez de nouveaux clients facilement.</p>
                        <a href="pages/clients/ajouter.php" class="btn btn-light">Ajouter un client</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Ajouter un employé</h5>
                        <p class="card-text">Ajoutez de nouveaux employés facilement.</p>
                        <a href="pages/employes/ajouter.php" class="btn btn-light">Ajouter un employé</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Ajouter un document</h5>
                        <p class="card-text">Ajoutez de nouveaux documents facilement.</p>
                        <a href="pages/documents/ajouter.php" class="btn btn-light">Ajouter un document</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>