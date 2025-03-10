<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header("Location: ../../connexion.php");
    exit;
}

// Vérifier si l'utilisateur est un admin
if ($_SESSION['role'] !== 'admin') {
    echo "Accès refusé. Vous n'avez pas les permissions nécessaires.";
    exit;
}

// Paramètres FTP
$ftp_server = "192.168.1.41";
$ftp_user = "ftpuser";
$ftp_password = "passer123";
$ftp_upload_dir = "/var/ftp/smartteh"; // Répertoire distant où stocker les fichiers

$message = "";

// Connexion FTP
$ftp_conn = ftp_connect($ftp_server);
if ($ftp_conn && ftp_login($ftp_conn, $ftp_user, $ftp_password)) {
    ftp_pasv($ftp_conn, true); // Mode passif si nécessaire

    // Récupération de la liste des fichiers du répertoire
    $files = ftp_nlist($ftp_conn, $ftp_upload_dir);

    if ($files === false) {
        $message = "Impossible de récupérer la liste des fichiers.";
        $files = [];
    }
} else {
    die("Erreur : Connexion au serveur FTP échouée.");
}

// Suppression d'un fichier si demandé
if (isset($_GET['delete'])) {
    $fileToDelete = $ftp_upload_dir . basename($_GET['delete']);
    if (ftp_delete($ftp_conn, $fileToDelete)) {
        $message = "Fichier supprimé avec succès.";
    } else {
        $message = "Erreur lors de la suppression du fichier.";
    }
    header("Location: index.php");
    exit;
}

// Fermeture de la connexion FTP
ftp_close($ftp_conn);
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