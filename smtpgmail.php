<?php
include("include/settings.php");
include "classes/class.phpmailer.php"; // include the class name
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "smtp.gmail.com";
$mail->Port = 587; // or 587
$mail->IsHTML(true);
$mail->Username = "samandeepkaur34@gmail.com";
$mail->Password = "";   
$mail->SetFrom("samandeepkaur34@gmail.com");
$mail->Subject = "Your Gmail SMTP Mail";
$mail->Body = "<b>Your password is ".$_SESSION["password"]."</b>";


$mail->AddAddress($_SESSION["email"]);		//mail address of sender

if(!$mail->Send())
{
	echo "Mailer Error: " . $mail->ErrorInfo;
}
else
{
	header("location:SentEmail.php");
}
?>