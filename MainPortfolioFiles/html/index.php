<?php
require_once './vendor/autoload.php';
$helperLoader = new SplClassLoader('Helpers', './vendor');
$mailLoader   = new SplClassLoader('SimpleMail', './vendor');
$helperLoader->register();
$mailLoader->register();
use Helpers\Config;
use SimpleMail\SimpleMail;
$config = new Config;
$config->load('./config/config.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = stripslashes(trim($_POST['name']));
    $email   = stripslashes(trim($_POST['email']));
    $subject = stripslashes(trim($_POST['subject']));
    $message = stripslashes(trim($_POST['message']));
    $pattern = '/[\r\n]|Content-Type:|Bcc:|Cc:/i';
    if (preg_match($pattern, $name) || preg_match($pattern, $email) || preg_match($pattern, $subject)) {
        die("Header injection detected");
    }
    $emailIsValid = filter_var($email, FILTER_VALIDATE_EMAIL);
    if ($name && $email && $emailIsValid && $subject && $message) {
        $mail = new SimpleMail();
        $mail->setTo($config->get('emails.to'));
        $mail->setFrom($config->get('emails.from'));
        $mail->setSender($name);
        $mail->setSubject($config->get('subject.prefix') . ' ' . $subject);
        $body = "
        <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
        <html>
            <head>
                <meta charset=\"utf-8\">
            </head>
            <body>
                <h1>{$subject}</h1>
                <p><strong>{$config->get('fields.name')}:</strong> {$name}</p>
                <p><strong>{$config->get('fields.email')}:</strong> {$email}</p>
                <p><strong>{$config->get('fields.message')}:</strong> {$message}</p>
            </body>
        </html>";
        $mail->setHtml($body);
        $mail->send();
        $emailSent = true;
    } else {
        $hasError = true;
    }
}
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!-- Your site name -->
	<title>Jordan C. Johnson</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" media="screen" href="css/reset.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="css/styles.css" />
	<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
	<script type="text/javascript" src="js/jquery.flow.1.2.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$("#menu").jFlow({
			slides: "#works",
			//if you got any problems with the content height, adjust the size below
			height: "590px",
			duration: 300
		});
	});
	</script>
</head>
<body>
<div id="all">
	<div id="header">
		<!-- Your site name -->
		<h1>Jordan C. Johnson</h1>
		<!-- Contact info -->
		<p>
		phone: 9999-9999<br />
		email: <a href="mailto:johnsonjordan188@gmail.com">johnsonjordan188@gmail.com</a>
		</p>
	</div>
	<!-- List of your works, each li element corresponds with a div inside div#works -->
	<ul id="menu">
		<li class="jFlowControl">My best work</li>
		<li class="jFlowControl">Another great work</li>
		<li class="jFlowControl">A nice project</li>
		<li class="jFlowControl">Contact Me</li>
	</ul>
	
	<div id="works">
	<!-- Your works, each div here corresponds to a li element in the ul#menu -->
		<div><!-- Inside this div is the first work -->
			<img src="works/work-one.jpg" alt="work one" />
			<h2>Here goes some details about the work.</h2>
			<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Integer quis turpis commodo massa ullamcorper fringilla. Aenean vitae purus. Praesent lorem magna, porttitor in, commodo porttitor, pretium eget, dolor. Proin eu metus a mi dignissim vulputate. Vivamus turpis justo, porta ullamcorper, imperdiet et, pharetra et, mauris. Integer eu diam. Cras non felis. Nam sit amet tortor nec sapien interdum ornare. Nullam laoreet aliquam dui. Sed sagittis. Suspendisse in nunc non leo ultrices congue. Quisque luctus erat ultrices tellus. Vivamus turpis justo, porta ullamcorper, imperdiet et, pharetra et, mauris. Integer eu diam. Cras non felis. Nam sit amet tortor nec sapien interdum ornare. Nullam laoreet aliquam dui. Sed sagittis. Suspendisse in nunc non leo ultrices congue. Quisque luctus erat ultrices tellus.</p>
		</div>
		<div><!-- Inside this div is the second work -->
			<img src="works/work-two.jpg" alt="work two" />
			<h2>Here goes some details about the work.</h2>
			<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Integer quis turpis commodo massa ullamcorper fringilla. Aenean vitae purus. Praesent lorem magna, porttitor in, commodo porttitor, pretium eget, dolor. Proin eu metus a mi dignissim vulputate. Vivamus turpis justo, porta ullamcorper, imperdiet et, pharetra et, mauris. Integer eu diam. Cras non felis. Nam sit amet tortor nec sapien interdum ornare. Nullam laoreet aliquam dui. Sed sagittis. Suspendisse in nunc non leo ultrices congue. Quisque luctus erat ultrices tellus.</p>
		</div>
		<div><!-- Inside this div is the third work -->
			<img src="works/work-three.jpg" alt="work three" />
			<h2>Here goes some details about the work.</h2>
			<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Integer quis turpis commodo massa ullamcorper fringilla. Aenean vitae purus. Praesent lorem magna, porttitor in, commodo porttitor, pretium eget, dolor. Proin eu metus a mi dignissim vulputate. Vivamus turpis justo, porta ullamcorper, imperdiet et, pharetra et, mauris. Integer eu diam. Cras non felis. Nam sit amet tortor nec sapien interdum ornare. Nullam laoreet aliquam dui. Sed sagittis. Suspendisse in nunc non leo ultrices congue. Quisque luctus erat ultrices tellus.</p>
		</div>
		
		
		<!-- Contact Form Div -->	
		<div id="contactform">
			<form name="contactform" method="post" action="index.php" enctype="multipart/form-data">
				<table width="450px">
					<tr>
						<td valign="top">
							<label for="name">Name *</label>
						</td>
						<td valign="top">
							<input  type="text" name="name" maxlength="50" size="30" placeholder="Please enter your name *" required="required" data-error="Name is required.">
						</td>
					</tr> 
					<tr>
						<td valign="top"">
 							<label for="email">Email Address *</label>
 						</td>
 						<td valign="top">
							<input  type="text" name="email" maxlength="50" size="30" placeholder="Please enter your email *" required="required" data-error="Valid email is required.">
						</td>
					</tr>			
					<tr>
						<td valign="top">
							<label for="subject">Subject *</label>
						</td>
						<td valign="top">
							<input  type="text" name="subject" maxlength="80" size="30" placeholder="Please enter a subject *" required="required" data-error="Please,leave us a message.">
						</td>
					</tr>
					<tr>
						<td style="vertical-align:middle"> 
							<label for="message">Message *</label>
						</td>
						<td valign="top">
							<textarea  name="message" maxlength="1000" size="30" cols="25" rows="6" placeholder="Your message for me *" required="required" data-error="Please,leave us a message."></textarea>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:center">
							<input type="submit" value="Submit"> </a>
						</td>
					</tr>
				</table>
			</form>
		</div>
		
	</div>
	<div id="footer">
		<p>
		<!-- Your copyright information -->
			&copy; 2016 Driven Software Development, Ltd. All Rights Reserved.
		</p>
	</div>
</div>
</body>
</html>
