<?php
include '../../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom_fichier = $_POST['nom_fichier'];
    $chemin_fichier = $_FILES['fichier']['name'];
    $dossier_upload = "/var/ftp/smarttech/";

    // Déplacer le fichier uploadé
    move_uploaded_file($_FILES['fichier']['tmp_name'], $dossier_upload . $chemin_fichier);

    $sql = "INSERT INTO documents (nom_fichier, chemin_fichier) VALUES (:nom_fichier, :chemin_fichier)";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['nom_fichier' => $nom_fichier, 'chemin_fichier' => $chemin_fichier]);

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Ajouter un document</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nom_fichier">Nom du fichier</label>
                <input type="text" class="form-control" id="nom_fichier" name="nom_fichier" required>
            </div>
            <div class="form-group">
                <label for="fichier">Fichier</label>
                <input type="file" class="form-control" id="fichier" name="fichier" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Ajouter</button>
        </form>
    </div>
</body>
</html>