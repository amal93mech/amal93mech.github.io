<?php

//ini_set('display_errors', 1);

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
require '../../vendor/autoload.php';

$cusName = $_POST['name'];
$cusPhone = $_POST['email'];
$cusMsg = $_POST['message'];

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'mail.netlogsolutions.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'contact@netlogsolutions.com';                 // SMTP username
    $mail->Password = 'amal93@nls';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('noreply@netlogsolutions.com', 'WebspaceAdmin');
    $mail->addAddress('netlogsolutions2017@gmail.com', 'Online Customer Handler');     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = "Web Contact: $cusName $cusPhone";
    $mail->Body    = "You have new message from your website contact form.\n\n<br>"."Here are the details.\n\n<br>Name: $cusName\n\n<br>Phone: $cusPhone\n\n<br>Message:\n\n$cusMsg";
    $mail->AltBody = "You have new message from website. $cusName $cusPhone $cusMsg";

    $mail->send();
    //echo 'Message has been sent';
} catch (Exception $e) {
    //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}