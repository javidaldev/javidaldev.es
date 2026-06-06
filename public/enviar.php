<?php
declare(strict_types=1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
}

// Honeypot: si el campo trampa viene relleno, es un bot. Respondemos OK sin enviar nada.
if (!empty($_POST['website'])) {
    echo json_encode(['ok' => true]);
    exit;
}

$nombre  = strip_tags(trim((string) ($_POST['nombre']  ?? '')));
$email   = trim((string) ($_POST['email']   ?? ''));
$mensaje = strip_tags(trim((string) ($_POST['mensaje'] ?? '')));

if (!$nombre || !$email || !$mensaje || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['ok' => false]);
    exit;
}

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/lib/PHPMailer/Exception.php';
require_once __DIR__ . '/lib/PHPMailer/PHPMailer.php';
require_once __DIR__ . '/lib/PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = SMTP_HOST;
    $mail->SMTPAuth   = true;
    $mail->Username   = SMTP_USER;
    $mail->Password   = SMTP_PASS;
    $mail->SMTPSecure = ((int) SMTP_PORT === 465)
        ? PHPMailer::ENCRYPTION_SMTPS
        : PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = (int) SMTP_PORT;
    $mail->CharSet    = PHPMailer::CHARSET_UTF8;

    $mail->setFrom(SMTP_USER, 'javidaldev.es');
    $mail->addAddress(MAIL_TO);
    $mail->addReplyTo($email, $nombre);

    $mail->Subject = "Mensaje de {$nombre} — javidaldev.es";
    $mail->Body    = "Nombre: {$nombre}\nEmail: {$email}\n\n{$mensaje}";

    $mail->send();
    echo json_encode(['ok' => true]);
} catch (PHPMailerException $e) {
    http_response_code(500);
    echo json_encode(['ok' => false]);
}
