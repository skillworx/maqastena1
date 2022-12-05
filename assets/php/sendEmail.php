﻿<?php

$to = 'info@maqastena.be';

function url(){
  return sprintf(
    "%s://%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['SERVER_NAME']
  );
}

if($_POST) {

   $name = trim(stripslashes($_POST['name']));
   $email = trim(stripslashes($_POST['email']));
   $subject = trim(stripslashes($_POST['subject']));
   $contact_message = trim(stripslashes($_POST['message']));

   
	if ($subject == '') { $subject = "Contact Form Submission"; }

   $message .= "Email van: " . $name . "<br />";
	$message .= "Email adres: " . $email . "<br />";
   $message .= "Bericht: <br />";
   $message .= nl2br($contact_message);
   $message .= "<br /> ----- <br /> Dit bericht is verzonden van je website " . url() . " contactformulier. <br />";

   $from =  $name . " <" . $email . ">";


	$headers = "From: " . $from . "\r\n";
	$headers .= "Reply-To: ". $email . "\r\n";
 	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

   ini_set("sendmail_from", $to); 
   $mail = mail($to, $subject, $message, $headers);

	if ($mail) { echo "OK"; }
   else { echo "Something went wrong. Please try again."; }

}

?>