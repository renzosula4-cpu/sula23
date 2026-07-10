<?php
/**
 * contact-handler.php
 * -----------------------------------------------------------------------
 * Processes the terminal-style contact form from index.php.
 *
 * No SMTP server is assumed, so instead of mail() (which usually fails
 * silently on shared/dev hosts with no mail transfer agent configured),
 * messages are validated and appended to data/messages.json.
 *
 * To send real email instead, swap the file_put_contents() block below
 * for mail() or a transactional email API (Postmark, SES, etc).
 * -----------------------------------------------------------------------
 */

declare(strict_types=1);

session_start();

$config = require __DIR__ . '/config.php';
$dataFile = __DIR__ . '/data/messages.json';

function redirect_with(string $status, string $message): never
{
    $_SESSION['contact_status']  = $status;
    $_SESSION['contact_message'] = $message;
    header('Location: index.php#contact');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_with('error', 'Invalid request method.');
}

// Honeypot field — bots tend to fill every input, humans never see this one.
if (!empty($_POST['website'])) {
    redirect_with('success', "Message sent — I'll get back to you soon.");
}

$name    = trim((string)($_POST['name'] ?? ''));
$email   = trim((string)($_POST['email'] ?? ''));
$message = trim((string)($_POST['message'] ?? ''));

$errors = [];

if ($name === '' || mb_strlen($name) > 100) {
    $errors[] = 'name looks invalid';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'email looks invalid';
}
if ($message === '' || mb_strlen($message) > 2000) {
    $errors[] = 'message is empty or too long';
}

if ($errors) {
    redirect_with('error', 'Could not send: ' . implode(', ', $errors) . '.');
}

$entry = [
    'name'    => htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
    'email'   => htmlspecialchars($email, ENT_QUOTES, 'UTF-8'),
    'message' => htmlspecialchars($message, ENT_QUOTES, 'UTF-8'),
    'time'    => date('c'),
    'ip'      => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
];

$existing = [];
if (is_file($dataFile)) {
    $raw = file_get_contents($dataFile);
    $existing = json_decode($raw ?: '[]', true) ?: [];
}
$existing[] = $entry;

$written = @file_put_contents(
    $dataFile,
    json_encode($existing, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
);

if ($written === false) {
    redirect_with('error', 'Server could not save your message. Try emailing directly.');
}

redirect_with('success', "Message received — I'll reply at {$entry['email']} soon.");
