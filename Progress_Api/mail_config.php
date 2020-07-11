<?php
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier  ssl
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server smtp.gmail.com
$mail->Port = 465;                  // set the SMTP port for the GMAIL    465                                       
$mail->Username   = "sagarjagani9@gmail.com";  // GMAIL username
$mail->Password   = "Sagar@1997";            // GMAIL password
$mail->SMTPAuth   = true;                  // enable SMTP authentication

//https://www.google.com/settings/security/lesssecureapps
?>