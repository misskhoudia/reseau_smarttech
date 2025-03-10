<?php
// Paramètres de connexion
$host = "localhost";
$dbname = "smarttech"; // Remplace par le nom de ta base
$username = "root"; // Par défaut sous XAMPP
$password = ""; // Aucun mot de passe sous XAMPP

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Échec de connexion : " . $e->getMessage());
}
?>
