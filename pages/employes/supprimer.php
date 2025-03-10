<?php
include '../../includes/db.php';

$id = $_GET['id'];
$sql = "DELETE FROM employes WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->execute(['id' => $id]);

header('Location: index.php');
?>