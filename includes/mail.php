<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendEmail($to, $subject, $body) {
    // Paramètres SMTP
    $smtp_host = "smtp.smarttech.local"; // Serveur SMTP d'iRedMail
    $smtp_port = 587; 
    $smtp_username = "no-reply@smarttech.local"; // Adresse e-mail d'envoi
    $smtp_password = "passer123"; // Mot de passe SMTP

    // Configuration de PHPMailer
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = $smtp_host;
        $mail->SMTPAuth = true;
        $mail->Username = $smtp_username;
        $mail->Password = $smtp_password;
        $mail->SMTPSecure = 'tls'; // Utilisez 'ssl' si vous utilisez le port 465
        $mail->Port = $smtp_port;

        // Expéditeur et destinataire
        $mail->setFrom($smtp_username, 'No Reply');
        $mail->addAddress($to);

        // Contenu de l'e-mail
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        // Envoi de l'e-mail
        $mail->send();
        return "E-mail envoyé avec succès !";
    } catch (Exception $e) {
        return "Erreur lors de l'envoi de l'e-mail : " . $mail->ErrorInfo;
    }
}
?>