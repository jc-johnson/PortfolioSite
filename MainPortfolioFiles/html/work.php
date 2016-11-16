<?php
	if (isset($_POST["submit"])) {
		/* input attributes */
		$name = $_POST['name'];
		$email = $_POST['email'];
		$subject = $_POST['subject'];
		$message = $_POST['message'];

		/* variables to send email */
		$from = 'Demo Contact Form'; 
		$to = 'jjohnson@myself.com'; 		/* Input your email here to recieve message */
		$subject = 'Message from Contact Demo ';
		 
		$body = "From: $name\n E-Mail: $email\n Subject: $subject\n Message:\n $message";

		/* Form Validation */
		if (!$_POST['name']) {
			$errName = 'Please enter your name';
		}

		if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$errEmail = 'Please enter a valid email address';
		}

		if (!$_POST['subject']) {
			$errName = 'Please enter a subject';
		}

		if (!$_POST['message']) {
			$errName = 'Please enter a message';
		}

		// If there are no errors, send the email
		if (!$errName && !$errEmail && !$errMessage && !$errHuman) {
			if (mail ($to, $subject, $body, $from)) {
				$result='<div class="alert alert-success">Thank You! I will be in touch</div>';
			} else {
				$result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later</div>';
			}
		}
	}
?>
