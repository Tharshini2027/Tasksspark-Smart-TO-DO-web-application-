<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Create instance
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = ''; // Gmail SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = ''; // Your Gmail
    $mail->Password = ''; // Your app password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = ;

    // Sender & recipient
    $mail->setFrom('', 'TaskSpark');
    $mail->addAddress($_POST['email']);

    // Message
    $otp = rand(, );
    session_start();
    $_SESSION['otp'] = $otp;

    $mail->isHTML(true);
    $mail->Subject = 'Your TaskSpark OTP';
    $mail->Body    = "Your OTP is: <b>$otp</b>";

    $mail->send();
    echo "OTP sent!";
} catch (Exception $e) {
    echo "Mailer Error: {$mail->ErrorInfo}";
}
?>
