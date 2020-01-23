<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

//use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$mess = $_POST["mess"];  
 $sub = $_POST["sub"];
 $to="imani_sterling@yahoo.com";
$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                                  // TCP port to connect to

    //Recipients
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress('imani_sterling@yahoo.com', 'Joe User');     // Add a recipient
 

   
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject =$sub;
    $mail->Body    = $mess;
  

    $mail->send();
    echo 'Message has been sent';

    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;

?>