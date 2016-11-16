<?php 
	error_reporting(-1);

	/* Set e-mail recipient */
	$myemail  = "johnsonjordan188@gmail";

	/* Check all form inputs using check_input function */
	$yourname = check_input($_POST['name'], "Enter your name");
	$subject  = check_input($_POST['subject'], "Write a subject");
	$email    = check_input($_POST['email'], "Enter your email");
	$message  = check_input($_POST['message'], "Write your message");

	/* If e-mail is not valid show error message */
	if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
	{
		show_error("E-mail address not valid");
	}

	/* If URL is not valid set $website to empty */
	if (!preg_match("/^(https?:\/\/+[\w\-]+\.[\w\-]+)/i", $website))
	{
		$website = '';
	}

	/* Let's prepare the message for the e-mail */
	$message = "Hello!

	Your contact form has been submitted by:

	Name: $yourname
	E-mail: $email
	Subject: $subject


	Message:
	$message

	End of message
	";

	/* Send the message using mail() function */
	if(mail($myemail,$subject,$message)) 
	{
		$msg = "Mail sent";

		echo $msg;
	} 

	print "<p>Thanks $name</p>" ;
	}



	/* Functions we used */
	function check_input($data, $problem='')
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		if ($problem && strlen($data) == 0)
		{
			show_error($problem);
		}
		return $data;
	}

	function show_error($myError)
	{
	?>
		<html>
		<body>

		<b>Please correct the following error:</b><br />
		<?php echo $myError; ?>

		</body>
		</html>
	<?php
	exit();
	}
?>

