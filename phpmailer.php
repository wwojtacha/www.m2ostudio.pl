<?php
//$msg = '';
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
//try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'example@gmail.com';                 // SMTP username
    $mail->Password = 'password';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $senderName = $_POST['name'];
    $senderAddress = $_POST['email'];
    $mail->setFrom('example@gmail.com', 'My website');
    $mail->addAddress('biuro@m2ostudio.pl', 'M2O Studio');     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Inf    ormation');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment($_FILES['attachment']['tmp_name'], $_FILES['attachment']['name']);
        if (isset($_FILES['attachment']) &&
            $_FILES['attachment']['error'] == UPLOAD_ERR_OK) {
            $mail->AddAttachment($_FILES['attachment']['tmp_name'],
                                 $_FILES['attachment']['name']);
        }
    
    //$mail->addAttachment($);         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name want to know senders email entered in contact form

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $_POST['subject'];
    $mail->Body    = 'Od (imię): ' . $senderName . '<br>' . 'Od (adres): ' . $senderAddress . '<br>' . 'Treść: ' . '<br>' . $_POST['message'];
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if (!$mail->send()) {
       echo '<script>alert("Niestety wiadomość nie ostała wysłana. Proszę spróbować jeszcze raz.")</script>';
        echo 'Mailer error: ' . $mail->ErrorInfo;
    } else {
        echo '<script>
        alert("Wiadomość została wysłana."); 
        window.location.replace("index.html");
        </script>';
    }
