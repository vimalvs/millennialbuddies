<?php
include '../includes/prepend.php';

if (empty($_POST['name'])) {
	printr("Please Enter Your Name");
	exit;
} else if (empty($_POST['email'])) {
	printr("Please Enter Your Email");
	exit;
} else if (empty($_POST['subject'])) {
	printr("Please Enter the subject");
	exit;
} else if (empty($_POST['message'])) {
	printr("Please Enter your message");
	exit;
}  else {
	$name = $_POST['name'];
	$mail = $_POST['email'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	$email = new \SendGrid\Mail\Mail(); 
	$email->setFrom("contact@millenialbuddies.com", "Contact Us");
	$email->setSubject($subject);
	$email->addTo("lakshmi.millenialbuddies@gmail.com", "Millenial Buddies");
	$body = "Sender Email : $mail \r\n Sender ?Name : $name \r\n".$message;

	$email->addContent("text/plain", $body);
	$sendgrid = new \SendGrid(SENDGRID_KEY);
	try {
	    $response = $sendgrid->send($email);
	    if ($response->statusCode() == 202) {
			printr("Thank you for your message. We will contact you soon.");	    	
	    }
	} catch (Exception $e) {
	    echo 'Caught exception: '. $e->getMessage() ."\n";
	}
}
