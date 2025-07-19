<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'config.php';
    require 'PHPMailer.php';
    require 'SMTP.php';
    require 'Exception.php';

    $mail = new PHPMailer(true);

    try {
        //SMTP Settings
        $mail -> isSMTP();
        $mail -> Host = 'smtp.zyro.com';
        $mail -> SMTPAuth = true;
        $mail -> Username = SMTP_USERNAME;
        $mail -> Password = SMTP_PASSWORD;
        $mail -> SMTPSecure = 'ssl';
        $mail -> Port = 465;
        
        //From & To
        $mail -> isHTML(false);
        $mail -> Subject = 'New Contact Form Submission';
        $mail -> Body = 
            "First Name: {$_POST['fname']}\n" .
            "Last Name: {$_POST['lname']}\n" .
            "Email: {$_POST['email']}\n" .
            "Message:\n{$_POST['textbox']}";
        $mail -> send();
        echo 'Message sent successfully';
    } catch (Exception $e) {
        echo "Message failed. Mail Error: {$mail -> ErrorInfo}";
    }
?>