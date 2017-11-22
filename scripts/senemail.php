<?php
	require 'PHPMailer.php';

	$mail = new PHPMailer;

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';                       // Specify main and backup server
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'drivermanagementqueries@gmail.com'      
	$mail->Password = 'Napier123!';               // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
	$mail->Port = 587;                                    //Set the SMTP port number - 587 for authenticated TLS
	$mail->setFrom('drivermanagementqueries@gmail.com', 'driver updates');     //Set who the message is to be sent from
	$mail->addAddress('jsweeney91@gmail.com', 'jordan sweeney');  // Add a recipient

	$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
	$mail->isHTML(false);                                  // Set email format to HTML

	$mail->Subject = 'Account Updates';
	$mail->Body    = 'This is the HTML message body <b>in bold!</b>';

	if(!$mail->send()) {
	   echo 'Message could not be sent.';
	   echo 'Mailer Error: ' . $mail->ErrorInfo;
	   exit;
	}

	echo 'Message has been sent';
?>