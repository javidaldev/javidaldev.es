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

if (!$nombre || !$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['ok' => false]);
    exit;
}

// Whitelist de orígenes → asunto. El valor crudo de $_POST no se usa directamente.
$origenes = [
    'home'       => '[javidaldev:contacto] %s',
    'diseno-web' => '[javidaldev:diseño-web] %s',
];
$origen = trim((string) ($_POST['origen'] ?? ''));
$asunto = sprintf($origenes[$origen] ?? '[javidaldev:contacto] %s', $nombre);

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/lib/PHPMailer/Exception.php';
require_once __DIR__ . '/lib/PHPMailer/PHPMailer.php';
require_once __DIR__ . '/lib/PHPMailer/SMTP.php';

function crearMailer(): PHPMailer
{
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = SMTP_HOST;
    $mail->SMTPAuth   = true;
    $mail->Username   = SMTP_USER;
    $mail->Password   = SMTP_PASS;
    $mail->SMTPSecure = ((int) SMTP_PORT === 465)
        ? PHPMailer::ENCRYPTION_SMTPS
        : PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port    = (int) SMTP_PORT;
    $mail->CharSet = PHPMailer::CHARSET_UTF8;
    return $mail;
}

const CUESTIONARIO_WEB    = 'https://docs.google.com/forms/d/17Lt7YTirypThtbzBbYvEhAYR4pzhUc0ikXjPbSHLJ7Q/viewform';
const CUESTIONARIO_TIENDA = 'https://docs.google.com/forms/d/1lB87CjNDGZRdmqx6mc5D97cD3Mxmgtke-XHT9Xg94WQ/viewform';

function plantillaAutorespuestaPresentacion(): string
{
    $cuestionarioWeb = CUESTIONARIO_WEB;

    return <<<TXT
Hola:

Gracias por escribirme y contarme un poco sobre tu proyecto.

Me dices que buscas una web para presentar tu negocio y recibir contactos: explicar quién eres, mostrar lo que haces y que tus clientes puedan escribirte, llamarte o pedirte presupuesto con facilidad. Perfecto, ese es justo mi terreno.

Para preparar una propuesta útil, te dejo un cuestionario sobre tu negocio y lo que necesitas de la web:

→ {$cuestionarioWeb}

No es un examen: responde lo que sepas, y lo que no lo tengas claro lo vemos juntos después.

Cuando tenga tus respuestas, preparo una propuesta por fases: lo imprescindible para arrancar y lo que puede quedar para más adelante.

¿Prefieres contármelo de viva voz? Respóndeme con tu teléfono y cuándo te viene bien, y te llamo.

Un saludo,
TXT;
}

function plantillaAutorespuestaTienda(): string
{
    $cuestionarioTienda = CUESTIONARIO_TIENDA;

    return <<<TXT
Hola:

Gracias por escribirme y contarme un poco sobre tu proyecto.

Me dices que necesitas una tienda online: que tus clientes puedan comprar y pagar directamente en tu web, con su catálogo, sus envíos y sus pedidos. Perfecto, ese es justo mi terreno.

Para preparar una propuesta útil, te dejo un cuestionario sobre tu negocio, tus productos y lo que necesitas de la tienda:

→ {$cuestionarioTienda}

Es algo más largo que el de una web normal porque una tienda tiene más piezas (catálogo, pagos, envíos), pero no es un examen: responde lo que sepas, y lo que no lo tengas claro lo vemos juntos después.

Cuando tenga tus respuestas, preparo una propuesta por fases: lo imprescindible para empezar a vender y lo que puede quedar para más adelante.

¿Prefieres contármelo de viva voz? Respóndeme con tu teléfono y cuándo te viene bien, y te llamo.

Un saludo,
TXT;
}

function plantillaAutorespuestaIndecisa(): string
{
    $cuestionarioWeb    = CUESTIONARIO_WEB;
    $cuestionarioTienda = CUESTIONARIO_TIENDA;

    return <<<TXT
Hola:

Gracias por escribirme y contarme un poco sobre tu proyecto.

Para preparar una propuesta útil, primero necesito entender si lo que buscas encaja mejor como web de presentación o como tienda online. La diferencia es sencilla y se reduce a una cosa: el cobro.

* Si quieres explicar quién eres, mostrar tus servicios o trabajos, y recibir mensajes, llamadas, WhatsApp, solicitudes de presupuesto o reservas, hablamos de una web de presentación.
* Si necesitas que tus clientes compren y paguen directamente en la web, con catálogo, carrito, envíos y gestión de pedidos, hablamos de una tienda online.

No pasa nada si aún no lo tienes claro. Te dejo los dos cuestionarios; empieza por el que más se parezca a lo que tienes en mente (no hace falta rellenar los dos):

1. Web de presentación → {$cuestionarioWeb}
2. Tienda online → {$cuestionarioTienda}

Si al revisar tus respuestas veo que el proyecto va por otro camino, te lo diré antes de preparar nada.

Y un apunte por si dudas pensando en el futuro: si empiezas con una web de presentación y más adelante quieres vender online, la tienda se añade sobre la misma web. No se empieza de cero.

Cuando tenga tus respuestas, preparo una propuesta por fases: lo imprescindible para arrancar y lo que puede quedar para más adelante.

¿Prefieres contármelo de viva voz? Respóndeme con tu teléfono y cuándo te viene bien, y te llamo. En diez minutos lo aclaramos entre los dos.

Un saludo,
TXT;
}

// Plantilla de autorespuesta del formulario de /diseno-web, según la opción marcada en "necesidad".
// Sin opción reconocida, se trata como "aún no lo tengo claro" (la opción que no compromete nada).
function plantillaAutorespuesta(string $necesidad): string
{
    return match ($necesidad) {
        'presentacion' => plantillaAutorespuestaPresentacion(),
        'tienda'       => plantillaAutorespuestaTienda(),
        default        => plantillaAutorespuestaIndecisa(),
    };
}

// Firma de marca (brand/firma-mail.html), añadida una sola vez al final de la autorespuesta.
function firmaAutorespuesta(): string
{
    return <<<HTML
<table cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;">
  <tr>
    <td>
      <img src="https://javidaldev.es/assets/images/javidaldev_short.png" alt="javidaldev" width="75" height="75" style="display:block;border:0;border-radius: 50%;padding-right: 5px;" />
    </td>
    <td style="border-left:3px solid #e57a39;padding-left:16px;">
      <img src="https://javidaldev.es/assets/wordmark/wordmark-javidaldev.png" alt="javidaldev" width="152" height="26" style="display:block;border:0;outline:none;text-decoration:none;margin-bottom:8px;" />
      <div style="font-family:'IBM Plex Sans',Arial,Helvetica,sans-serif;font-size:13px;color:#17120c;"><span style="font-weight:700;">Javier Vidal</span> &nbsp;&middot;&nbsp; Senior full-stack</div>
      <div style="font-family:'IBM Plex Sans',Arial,Helvetica,sans-serif;font-size:12px;color:#6f6451;margin-top:1px;">C#&nbsp;&middot;&nbsp;.NET&nbsp;&middot;&nbsp;Angular</div>
      <div style="font-family:'IBM Plex Sans',Arial,Helvetica,sans-serif;font-size:12px;margin-top:12px;padding-top:12px;border-top:1px solid #e7ded0;">
        <a href="https://javidaldev.es" target="_blank" rel="noopener" style="color:#17120c;text-decoration:none;font-weight:700;">javidaldev.es</a><span style="color:#e57a39;">&nbsp;&nbsp;&middot;&nbsp;&nbsp;</span><a href="https://javidaldev.es/github" target="_blank" rel="noopener" style="color:#17120c;text-decoration:none;">GitHub</a><span style="color:#e57a39;">&nbsp;&nbsp;&middot;&nbsp;&nbsp;</span><a href="https://javidaldev.es/linkedin" target="_blank" rel="noopener" style="color:#17120c;text-decoration:none;">LinkedIn</a>
      </div>
    </td>
  </tr>
</table>
HTML;
}

// Autorespuesta al remitente: solo en la landing /diseno-web, que es la que pregunta "necesidad".
// El contacto de la home no lleva esa pregunta, así que no tiene autorespuesta.
function enviarAutorespuesta(string $email, string $nombre, string $necesidad): void
{
    try {
        $cuerpo = nl2br(htmlspecialchars(plantillaAutorespuesta($necesidad)), false);

        $auto = crearMailer();
        $auto->isHTML(true);
        $auto->setFrom('javi@javidaldev.es', 'Javi · javidaldev');
        $auto->addAddress($email, $nombre);
        $auto->Subject = 'He recibido tu mensaje · javidaldev';
        $auto->Body    = '<div style="font-family:\'IBM Plex Sans\',Arial,Helvetica,sans-serif;font-size:14px;color:#17120c;">'
            . $cuerpo
            . '</div><br><br>'
            . firmaAutorespuesta();
        $auto->send();
    } catch (PHPMailerException $e) {
        // Autorespuesta opcional: si falla, no afecta a la notificación ya enviada.
    }
}

try {
    $mail = crearMailer();
    $mail->setFrom(SMTP_USER, 'javidaldev.es');
    $mail->addAddress(MAIL_TO);
    $mail->addReplyTo($email, $nombre);

    $mail->Subject = $asunto;
    $mail->Body    = "Nombre: {$nombre}\nEmail: {$email}\n\n{$mensaje}";

    $mail->send();

    if ($origen === 'diseno-web') {
        $necesidad = trim((string) ($_POST['necesidad'] ?? ''));
        enviarAutorespuesta($email, $nombre, $necesidad);
    }

    echo json_encode(['ok' => true]);
} catch (PHPMailerException $e) {
    http_response_code(500);
    echo json_encode(['ok' => false]);
}
