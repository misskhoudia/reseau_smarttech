<?php
include '../../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $entreprise = $_POST['entreprise'];

    $sql = "UPDATE clients SET nom = :nom, prenom = :prenom, email = :email, entreprise = :entreprise WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id, 'nom' => $nom, 'prenom' => $prenom, 'email' => $email, 'entreprise' => $entreprise]);

    header('Location: index.php');
}

$id = $_GET['id'];
$sql = "SELECT * FROM clients WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->execute(['id' => $id]);
$client = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Modifier un client</h1>
        <form method="POST">
            <input type="hidden" name="id" value="<?= $client['id'] ?>">
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?= $client['nom'] ?>" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="<?= $client['prenom'] ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $client['email'] ?>" required>
            </div>
            <div class="form-group">
                <label for="entreprise">Entreprise</label>
                <input type="text" class="form-control" id="entreprise" name="entreprise" value="<?= $client['entreprise'] ?>" required>
            </div>
            <button type="submit" class="btn btn-warning mt-3">Modifier</button>
        </form>
    </div>
</body>
</html>