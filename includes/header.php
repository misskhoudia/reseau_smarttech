<?php
// Vérifier si la connexion à la base de données est déjà incluse
if (!isset($conn)) {
    include_once __DIR__ . '/db.php';
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/Projet_Smarttech/index.php">Smarttech</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/Projet_Smarttech/index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Projet_Smarttech/pages/clients/index.php">Clients</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Projet_Smarttech/pages/clients/ajouter.php">Ajouter un client</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
