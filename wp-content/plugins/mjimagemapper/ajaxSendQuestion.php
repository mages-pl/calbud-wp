<?php

 
//Load Composer's autoloader
require 'vendor/autoload.php';

require_once("../../../wp-load.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

if(!empty($_POST['tresc'])
&& !empty($_POST['imie_nazwisko'])
&& !empty($_POST['telefon'])
&& !empty($_POST['email'])
&& (int)($_POST['rule1'] == 1)
&& (int)($_POST['rule2'] == 1)
) {
try {
    //Server settings
    //Enable verbose debug output
    #$mail->SMTPDebug = SMTP::DEBUG_SERVER;
    
    //Send using SMTP
    $mail->isSMTP();
    //Set the SMTP server to send through
    $mail->Host       = get_option('mjimagemapper_smtp_host');
    //Enable SMTP authentication
    $mail->SMTPAuth   = true;
    //SMTP username
    $mail->Username   = get_option('mjimagemapper_smtp_user');
    //SMTP password
    $mail->Password   = get_option('mjimagemapper_smtp_password');
    //Enable implicit TLS encryption
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mail->Port       = get_option('mjimagemapper_smtp_port');

    // Language 
    //$mail->setLanguage('pl');
    $mail->CharSet = "UTF-8";
    //Recipients
    $mail->setFrom(get_option('mjimagemapper_smtp_user'), get_bloginfo('name'));
    //Add a recipient
    $mail->addAddress(get_option('mjimagemapper_smtp_user'), 'Obsługa klienta');
    
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    
    $tresc = $_POST['tresc']." <br/><br/> Dane klienta: <br/><br/> Imię i nazwisko: ".$_POST['imie_nazwisko']."<br/>E-mail:".$_POST['email']."<br/>Telefon:".$_POST['telefon'];

    //Content
    $mail->isHTML(true);                                  
    
    $mail->Subject = "Zapytanie o lokal ".$_POST['lokal']." w inwestycji ".$_POST['inwestycja'];
    $mail->Body = $tresc;
    $mail->AltBody = $tresc;

    $mail->send();
    echo '1';
} catch (Exception $e) {
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    echo "0";
}
} else {
    echo "0";
}

exit();
