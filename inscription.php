<?php
session_start();

// Connexion à la base de données
include_once __DIR__ . '/includes/db.php';

// Traitement du formulaire d'inscription
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = htmlspecialchars($_POST['nom']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_BCRYPT);
    $role = $_POST['role']; // Récupération du rôle depuis le formulaire

    // Vérification que l'email n'existe pas déjà
    $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        $erreur = "Cet email est déjà utilisé.";
    } else {
        // Insertion dans la base de données
        $stmt = $conn->prepare("INSERT INTO utilisateurs (nom, email, mot_de_passe, role) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$nom, $email, $mot_de_passe, $role])) {
            $succes = "Inscription réussie !";
        } else {
            $erreur = "Erreur lors de l'inscription.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Projet Smarttech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            margin-top: 100px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: white;
            text-align: center;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Inscription</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($erreur)) : ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($erreur) ?></div>
                        <?php endif; ?>
                        <?php if (isset($succes)) : ?>
                            <div class="alert alert-success"><?= htmlspecialchars($succes) ?></div>
                        <?php endif; ?>

                        <form action="inscription.php" method="POST">
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom :</label>
                                <input type="text" name="nom" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email :</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="mot_de_passe" class="form-label">Mot de passe :</label>
                                <input type="password" name="mot_de_passe" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Rôle :</label>
                                <select name="role" class="form-control" required>
                                    <option value="employe">Employé</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
                        </form>
                        <div class="mt-3 text-center">
                            <p>Déjà inscrit ? <a href="connexion.php">Se connecter</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>