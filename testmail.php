<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host         = 'smtp.gmail.com';
    $mail->SMTPAuth     = true;
    $mail->Username     = 'm.heilikman@gmail.com';
    $mail->Password     = 'dznv zosm mwpp fmgz'; // mot de passe d'application PHPMailer
    $mail->SMTPSecure   = 'tls';
    $mail->CharSet      = 'UTF-8';
    $mail->Port         = 587;

    $mail->setFrom('m.heilikman@gmail.com', 'Michael Heilikman');
    $mail->addAddress('michael.heilikman@ifip.asso.fr', 'Michael Heilikman');     // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('claude.montariol@ifip.asso.fr');
    // $mail->addBCC('bcc@example.com');

    // Attachments
    // $mail->addAttachment('C:\Temp\imgtest.png');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This Nouvelle pré-inscription au Code des Usages is the HTML gestion message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Gestion Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}