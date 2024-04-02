<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Input validation
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $mobile_number = $_POST["mobile_number"];
    $email_subject = $_POST["email_subject"];
    $message = $_POST["message"];

    if (empty($full_name) || empty($email) || empty($message)) {
        echo "Please fill in all required fields.";
        exit;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Sanitize input data
    $full_name = htmlspecialchars($full_name);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $mobile_number = filter_var($mobile_number, FILTER_SANITIZE_NUMBER_INT);
    $email_subject = htmlspecialchars($email_subject);
    $message = htmlspecialchars($message);

    // Prepare email content
    $to = "nitishnpoojary271@gmail.com";
    $subject = $email_subject;
    $message_body = "Full Name: $full_name\nEmail: $email\nMobile Number: $mobile_number\nMessage: $message";
    $headers = "From: $email";

    // Send email
    if (mail($to, $subject, $message_body, $headers)) {
        echo "Your message has been sent successfully.";
    } else {
        echo "There was an error sending your message.";
    }
}
?>
