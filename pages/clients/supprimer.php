<?php
include '../../includes/db.php';

$id = $_GET['id'];
$sql = "DELETE FROM clients WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->execute(['id' => $id]);

header('Location: index.php');
?>