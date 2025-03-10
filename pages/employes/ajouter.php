<?php
include '../../includes/db.php';

// Liste des postes disponibles
$postes = ["Développeur", "Designer", "Chef de projet", "Administrateur système", "Commercial"];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $poste = $_POST['poste'];

    $sql = "INSERT INTO employes (nom, prenom, email, poste) VALUES (:nom, :prenom, :email, :poste)";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['nom' => $nom, 'prenom' => $prenom, 'email' => $email, 'poste' => $poste]);

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un employé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Ajouter un employé</h1>
        <form method="POST">
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="poste">Poste</label>
                <select class="form-control" id="poste" name="poste" required>
                    <option value="">Sélectionnez un poste</option>
                    <?php foreach ($postes as $poste): ?>
                        <option value="<?= $poste ?>"><?= $poste ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Ajouter</button>
        </form>
    </div>
</body>
</html>