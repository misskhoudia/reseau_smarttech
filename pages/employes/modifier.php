<?php
include '../../includes/db.php';

// Liste des postes disponibles
$postes = ["Développeur", "Designer", "Chef de projet", "Administrateur système", "Commercial"];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $poste = $_POST['poste'];

    $sql = "UPDATE employes SET nom = :nom, prenom = :prenom, email = :email, poste = :poste WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id, 'nom' => $nom, 'prenom' => $prenom, 'email' => $email, 'poste' => $poste]);

    header('Location: index.php');
}

$id = $_GET['id'];
$sql = "SELECT * FROM employes WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->execute(['id' => $id]);
$employe = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un employé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Modifier un employé</h1>
        <form method="POST">
            <input type="hidden" name="id" value="<?= $employe['id'] ?>">
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?= $employe['nom'] ?>" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="<?= $employe['prenom'] ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $employe['email'] ?>" required>
            </div>
            <div class="form-group">
                <label for="poste">Poste</label>
                <select class="form-control" id="poste" name="poste" required>
                    <option value="">Sélectionnez un poste</option>
                    <?php foreach ($postes as $poste): ?>
                        <option value="<?= $poste ?>" <?= ($poste == $employe['poste']) ? 'selected' : '' ?>>
                            <?= $poste ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-warning mt-3">Modifier</button>
        </form>
    </div>
</body>
</html>