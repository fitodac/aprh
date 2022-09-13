<?php

// Get user IP
$ip = $_SERVER["REMOTE_ADDR"];

/*
  I collect all data via POST 
  With strip_tags remove HTML and PHP tags to avoid possible injection. 
  As managed database is not necessary to clean SQL injection.
*/
( $_POST['name'] == '' ) ? $name = "The user don't add a name" : $name = strip_tags($_POST['name']);
( $_POST['email'] == '' ) ? $email = "The user don't add an email" : $email = strip_tags($_POST['email']);
( $_POST['phone'] == '' ) ? $phone = "The user don't add a phone number" : $phone = strip_tags($_POST['phone']);
( $_POST['message'] == '' ) ? $message = "The user don't write a message" : $message = strip_tags($_POST['message']);

$time = time();
$date = date("j/n/Y", $time);




$headers = "MIME-VERSION: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";
$headers .= "From: ".$email;

// $recipe = 'fitodac@gmail.com';
$recipe = $email;


//Formateo el asunto del correo
$subject = "Contact from WEB_$name";
 
//Formateo el cuerpo del correo
$bodyemail = "<b>IP:</b> " .$ip. "<br/>";
$bodyemail .= "<b>Name:</b> " .$name. "<br/>";
$bodyemail .= "<b>Email:</b> " .$email. "<br/>";
$bodyemail .= "<b>Contact phone: </b>" .$phone. "<br/>";
$bodyemail .= "<b>Message:</b> " .$message. "<br/>";
$bodyemail .= "<br/>";
$bodyemail .= "<b>Created in </b> " .$date. "<br/>";



mail($recipe, $subject, utf8_decode($bodyemail), $headers);






