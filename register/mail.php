<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//required files
require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions

  $mail = new PHPMailer(true);

  //Server settings
  $mail->isSMTP();                              //Send using SMTP
  $mail->Host       = 'smtp.gmail.com';       //Set the SMTP server to send through
  $mail->SMTPAuth   = true;             //Enable SMTP authentication
  $mail->Username   = 'catbaloganpetcare@gmail.com';   //SMTP write your email
  //$mail->Password   = 'yqmzphdnunzusvgw';      //SMTP password for nagalislaer@gmail.com
  $mail->Password   = 'kerprtivwjudxels';
  $mail->SMTPSecure = 'ssl';            //Enable implicit SSL encryption
  $mail->Port       = 465;                                    

  //Recipients
  $mail->setFrom('catbaloganpetcare@gmail.com', 'Catbalogan Pet Care'); // Sender Email and name
  $mail->addAddress('realvsilagan0908@gmail.com');     //Add a recipient email  
  //$mail->addReplyTo($_POST["email"], $_POST["name"]); // reply to sender email

  //Content
  $mail->isHTML(true);               //Set email format to HTML
  $mail->Subject = 'Test Subject';   // email subject headings
  $mail->Body    = 'This is a message'; //email message

  // Success sent message alert
  $mail->send();
  echo
  " 
  <script> 
   alert('Message was sent successfully!');
   document.location.href = 'index.php';
  </script>
  ";

?>