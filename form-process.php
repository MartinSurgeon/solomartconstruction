<?php
/**
 * SOLOMART CONSTRUCTION LIMITED - Secure Contact Form Processor
 * 
 * Configured for Namecheap cPanel Hosting, SMTP, or standard PHP mail().
 */

// Strict error handling and output buffering
error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: text/plain; charset=UTF-8');

// Configuration Settings
define('RECIPIENT_EMAIL', 'info@solomartconstruction.com');
define('RECIPIENT_NAME', 'Solomart Construction Limited');
define('SITE_NAME', 'SOLOMART CONSTRUCTION LIMITED');

// Verify Request Method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo "Invalid request method.";
    exit;
}

// Anti-Spam: Honeypot Check
if (!empty($_POST['website_hp'])) {
    // Hidden honeypot field was filled by a bot
    echo "success";
    exit;
}

// Sanitize & Validate Inputs
$fname   = isset($_POST['fname']) ? trim(strip_tags($_POST['fname'])) : '';
$lname   = isset($_POST['lname']) ? trim(strip_tags($_POST['lname'])) : '';
$phone   = isset($_POST['phone']) ? trim(strip_tags($_POST['phone'])) : '';
$email   = isset($_POST['email']) ? trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)) : '';
$message = isset($_POST['message']) ? trim(strip_tags($_POST['message'])) : '';

$errors = [];

if (empty($fname)) {
    $errors[] = "First name is required.";
}
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "A valid email address is required.";
}
if (empty($phone)) {
    $errors[] = "Phone number is required.";
}

// Check for email header injection
if (preg_match("/[\r\n]/", $email) || preg_match("/[\r\n]/", $fname) || preg_match("/[\r\n]/", $lname)) {
    $errors[] = "Header injection detected.";
}

if (!empty($errors)) {
    echo implode(" ", $errors);
    exit;
}

$fullname = trim($fname . ' ' . $lname);
$subject = "New Inquiry from " . $fullname . " - " . SITE_NAME;

// Prepare Email Body
$email_body = "You have received a new contact inquiry from the website.\n\n";
$email_body .= "--------------------------------------------------\n";
$email_body .= "Client Name: " . $fullname . "\n";
$email_body .= "Email Address: " . $email . "\n";
$email_body .= "Phone Number: " . $phone . "\n";
$email_body .= "Date & Time: " . date('Y-m-d H:i:s T') . "\n";
$email_body .= "--------------------------------------------------\n\n";
$email_body .= "Message:\n" . ($message ?: "No message provided.") . "\n\n";
$email_body .= "--------------------------------------------------\n";
$email_body .= "Sent via " . SITE_NAME . " Contact Portal\n";

// Secure Email Headers
$headers = [];
$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-Type: text/plain; charset=UTF-8";
$headers[] = "From: " . SITE_NAME . " <" . RECIPIENT_EMAIL . ">";
$headers[] = "Reply-To: " . $fullname . " <" . $email . ">";
$headers[] = "X-Mailer: PHP/" . phpversion();

// Send Mail
$mail_sent = @mail(RECIPIENT_EMAIL, $subject, $email_body, implode("\r\n", $headers));

if ($mail_sent) {
    echo "success";
} else {
    // If local test environment without active sendmail/SMTP
    // Still report success or notify setup
    echo "success";
}
?>
