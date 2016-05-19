<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$name  = trim(filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING));
	$email = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
	$message = trim(filter_input(INPUT_POST, "message", FILTER_SANITIZE_SPECIAL_CHARS));
	
	$email_body = "";
	$email_body .= "name ".$name."\n";
	$email_body .= "email ".$email."\n";
	$email_body .= "details ".$details. "\n";
	
	require_once('inc/phpmailer/class.phpmailer.php');
	$mail = new PHPMailer;
	if (! $mail->validateAddress($email)){
		echo "Invalid email address.";
	};
	//To Do: Send email
	
	$mail->setFrom($email, 'Mailer');
	$mail->addAddress('gideongrossman@gmail.com', $name);     // Add a recipient
	//$mail->addAddress('ellen@example.com');               // Name is optional
	// $mail->addCC('cc@example.com');
	// $mail->addBCC('bcc@example.com');

	// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(false);                                  // Set email format to HTML

	$mail->Subject = 'Here is the subject';
	$mail->Body    = 'This is the HTML message body <b>in bold! ".$email_body</b>';
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	if(!$mail->send()) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
		exit;
	};
	
	header("location:suggest.php?status=thanks");
	exit;	};
?>	
	Thank you for submitting your reservation request. I will reply as soon as possible.

Have a great day!