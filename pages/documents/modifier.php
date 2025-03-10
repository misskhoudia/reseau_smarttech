<?php
include '../../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nom_fichier = $_POST['nom_fichier'];
    $chemin_fichier = $_FILES['fichier']['name'];
    $dossier_upload = "/var/ftp/smarttech/";

    // Déplacer le fichier uploadé
    move_uploaded_file($_FILES['fichier']['tmp_name'], $dossier_upload . $chemin_fichier);

    $sql = "UPDATE documents SET nom_fichier = :nom_fichier, chemin_fichier = :chemin_fichier WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id, 'nom_fichier' => $nom_fichier, 'chemin_fichier' => $chemin_fichier]);

    header('Location: index.php');
}

$id = $_GET['id'];
$sql = "SELECT * FROM documents WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->execute(['id' => $id]);
$document = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Modifier un document</h1>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $document['id'] ?>">
            <div class="form-group">
                <label for="nom_fichier">Nom du fichier</label>
                <input type="text" class="form-control" id="nom_fichier" name="nom_fichier" value="<?= $document['nom_fichier'] ?>" required>
            </div>
            <div class="form-group">
                <label for="fichier">Fichier</label>
                <input type="file" class="form-control" id="fichier" name="fichier">
            </div>
            <button type="submit" class="btn btn-warning mt-3">Modifier</button>
        </form>
    </div>
</body>
</html>