<?php 
error_reporting(E_ALL ^ E_NOTICE); // hide all basic notices from PHP

//If the form is submitted
if(isset($_POST['submitted'])) {
	
	// require a name from user
	if(trim($_POST['name']) === '') {
		$nameError =  'Forgot your name!'; 
		$hasError = true;
	} else {
		$name = trim($_POST['name']);
	}// require a name from user
	if(trim($_POST['worth']) === '') {
		$worthError =  'Forgot your worth!'; 
		$hasError = true;
	} else {
		$worth = trim($_POST['worth']);
        $worth = "$".number_format($worth).".00";
	}// require a name from user
	if(trim($_POST['owe']) === '') {
		$oweError =  'Forgot your owe!'; 
		
		$hasError = true;
	} else {
		$owe = trim($_POST['owe']);
        $owe = "$".number_format($owe).".00";
	}
	if(trim($_POST['repair']) === '') {
		$repairError =  'Forgot your repair!'; 
		$hasError = true;
	} else {
		$repair = trim($_POST['repair']);
	}
	if(trim($_POST['todo']) === '') {
		$todoError =  'Forgot your todo!'; 
		$hasError = true;
	} else {
		$todo = trim($_POST['todo']);
	}
	if(trim($_POST['web']) === '') {
		$webError =  'Forgot your Phone!'; 
		$hasError = true;
	} else {
		$web = trim($_POST['web']);
	}
	
	// need valid email
	if(trim($_POST['email']) === '')  {
		$emailError = 'Forgot to enter in your e-mail address.';
		$hasError = true;
	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
		$emailError = 'You entered an invalid email address.';
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}
		
	// we need at least some content
	if(trim($_POST['message']) === '') {
		$messageError = 'You forgot to enter a message!';
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$message = stripslashes(trim($_POST['message']));
		} else {
			$message = trim($_POST['comments']);
		}
	}
		
	// upon no failure errors let's email now!
	if(!isset($hasError)) {
		
		$emailTo = 'eddie@theallardcompany.com';
		$subject = 'Submitted message from '.$name;
		$sendCopy = trim($_POST['sendCopy']);
		$body = "Name: $name \n\nWorth: $worth \n\nOwe: $owe \n\nRepair: $repair \n\nTodo: $todo \n\nPhone: $web \n\nEmail: $email \n\nComments: $message";
		$headers = 'From: ' .' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		if(mail($emailTo, $subject, $body, $headers))
		{
				$emailSent = true;

		echo "Success";
		}
        else
	{
	echo "error";
	}
        // set our boolean completion value to TRUE
	}
	
}
?>
