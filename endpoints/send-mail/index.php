<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    header('Content-Type: application/json');

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = $config["email"]["host"];
    $mail->SMTPAuth = true;
    $mail->Username = $config["email"]["email"];
    $mail->Password = $config["email"]["password"];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = $config["email"]["port"];

    $mail->setFrom($config["email"]["email"], 'DELLA Immobilien GmbH - Webseite');
    $mail->addAddress($config["email"]["email"]);

    $mail->Subject = 'Neue Immobilienanfrage - DELLA Immobilien GmbH';
    
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $owner = htmlspecialchars($_POST["owner"]);
    $address = htmlspecialchars($_POST["address"]);
    $message = htmlspecialchars($_POST["message"]);

    $mail->Body = "
Neue Immobilienanfrage

Name: $name
E-Mail: $email
Telefon: $phone

Eigentümer: $owner
Adresse: $address

Zusätzliche Informationen:
$message
";

    try {
        if ($mail->send()) {
            http_response_code(201);
            exit;
        } else {
            http_response_code(500);
            exit;
        }
    } catch (Exception $e) {
        http_response_code(500);
        exit;
    }
} else {
    http_response_code(405);
    exit;
}