<?php
// Set your email address
$receiving_email_address = "datawithdisciples@gmail.com";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get form fields and remove extra spaces
    $name    = trim($_POST["name"] ?? '');
    $email   = trim($_POST["email"] ?? '');
    $subject = trim($_POST["subject"] ?? 'No Subject');
    $message = trim($_POST["message"] ?? '');

    // Simple validation
    if (empty($name) || empty($email) || empty($message)) {
        echo "Please fill in all required fields.";
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.";
        exit;
    }

    // Email content
    $email_content  = "From: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Message:\n$message\n";

    // Email headers
    $headers = "From: $name <$email>";

    // Send the email
    if (mail($receiving_email_address, $subject, $email_content, $headers)) {
        echo "success"; // You can change this to a JSON response if using AJAX
    } else {
        echo "There was a problem sending the email.";
    }
} else {
    echo "Invalid request.";
}
?>
