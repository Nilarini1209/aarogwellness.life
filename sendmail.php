<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name    = $_POST["name"];
    $email   = $_POST["email"];
    $phone   = $_POST["phone"];
    $message = $_POST["message"];

    $mail = new PHPMailer(true);

    try {
        // Main mail setup
        $mail->isSMTP();
        $mail->Host       = 'mail.aarogwellness.life';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'info@aarogwellness.life';
        $mail->Password   = '@AarogWellness2025';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('info@aarogwellness.life', 'Aarog Wellness');
        $mail->addAddress('info@aarogwellness.life');
        $mail->addReplyTo($email, $name);

        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body    = "
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Message:</strong><br>$message</p>
        ";

        $mail->send(); // ✅ Only send once

        // Auto-reply
        $autoReply = new PHPMailer(true);
        $autoReply->isSMTP();
        $autoReply->Host       = 'mail.aarogwellness.life';
        $autoReply->SMTPAuth   = true;
        $autoReply->Username   = 'info@aarogwellness.life';
        $autoReply->Password   = '@AarogWellness2025';
        $autoReply->SMTPSecure = 'tls';
        $autoReply->Port       = 587;

        $autoReply->setFrom('info@aarogwellness.life', 'Aarog Wellness');
        $autoReply->addAddress($email, $name);
        $autoReply->isHTML(true);
        $autoReply->Subject = 'Thank you for reaching out!';
        $autoReply->Body    = "
            <p>Hi $name,</p>
            <p>Thank you for reaching out to Aarog Wellness 🌸.</p>
            <p>Our team will connect with you shortly. In the meantime, pause and enjoy a moment of peace 🌾</p>
            <p>– Aarog Wellness Team</p>
        ";

        $autoReply->send();

        echo json_encode(['success' => true]); // ✅ Success

    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $mail->ErrorInfo]);
    }
}
