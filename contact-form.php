<?php

if (isset($_POST["submit"])) {
	$fname = $_POST['fname'];

	$lname = $_POST['lname'];

	$email = $_POST['email'];

	$number = $_POST['phone'];

	$message = $_POST['message'];


	$from = 'Contact Form'; 
	$to = 'pocockn@hotmail.co.uk'; 
	$subject = 'Message from Daily Electronic';
	 
	$body = "From: $name\n E-Mail: $email\n Message:\n $message";

	if (!$_POST['fname']) {
		$errFname = 'Please enter your first name';
	}

	if (!$_POST['lname']) {
		$errLname = 'Please enter your last name';
	}

	if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$errEmail = 'Please enter a valid email address';
	}

	if (!$_POST['phone']) {
		$errPhone = 'Please enter your phone number';
	}

	if (!$_POST['message']) {
		$errMessage = 'Please enter your message';
	}

	// If there are no errors, send the email
if (!$errFname && !$errLname && !$errEmail && !$errPhone && !$errMessage) {
    if (mail ($to, $subject, $body, $from)) {
        $result='<div class="alert alert-success">Thank You! I will be in touch</div>';
    } else {
        $result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later</div>';
    }
}
}

?>
