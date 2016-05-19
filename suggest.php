<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$name  = trim(filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING));
	$email = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
	$details = trim(filter_input(INPUT_POST, "details", FILTER_SANITIZE_SPECIAL_CHARS));
	if ($name == "" || $email == "" || $details == ""){
		echo "Please fill out name, email and details";
		exit;
	};
	if ($_POST["address"] != ""){
		echo "Go Home, spam bot.";
		exit;
	};
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
	$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	if(!$mail->send()) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
		exit;
	};
	
	header("location:suggest.php?status=thanks");
	exit;	};
	

	$pageTitle = "Suggest a Media Item";
	$section  = "suggest";
	include("inc/header.php");?>
	<div class = "section page">
	<div class = "wrapper">
	<?php if (isset($_GET["status"]) && $_GET['status'] == "thanks"){
			echo "<p>Thanks for the email! I&rsquo;ll check out your suggestion shortly!</p>";
		}
		else {?>
	
	<h1>Suggest a Media Item</h1>
		<p>If you think there is something I&#39;m missing, let me know! Complete the form to send me an email.			</p>
			<form method = "post" action = "suggest.php">
				<table>
					<tr>
						<th><label for = "name">Name</label></th>
						<td><input type = "text" id = "name" name = "name"/></td>
					</tr>
					<tr>
						<th><label for = "email">Email</label></th>
						<td><input type = "text" id = "email" name = "email"/></td>
					</tr>
					<tr>
						<th><label for = "details">Suggest Item Details</label></th>
						<td><textarea id = "details" name = "details"></textarea></td>
					</tr>
					<tr style="display:none">
						<th><label for = "address">Address</label></th>
						<td><input type = "text" id = "address" name = "address"/><p>Please leave this field blank.</p></td>
					</tr>
					</table>
					<input type = "submit" value = "Send"/>
			</form>
	</div>
	</div><?php }?>
	
<?php include("inc/footer.php");?>
