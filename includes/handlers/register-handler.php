<?php

	function sanitizeFormPassword($inputText) {
		$inputText = strip_tags($inputText); // replace all html tags on input
		return $inputText;
	}
	function sanitizeFormUsername($inputText) {
		$inputText = strip_tags($inputText); // replace all html tags on input
		$inputText = str_replace(" ", "", $inputText);
		return $inputText;
	}

	function sanitizeFormString($inputText) {
		$inputText = strip_tags($inputText); // replace all html tags on input
		$inputText = str_replace(" ", "", $inputText);
		$inputText = ucfirst(strtolower($inputText)); // first to lower and first to upper
		return $inputText;
    }

	if(isset($_POST['rigisterButton'])) {
		//Resgister pressed
		$username = sanitizeFormUsername($_POST['username']);
		$firstName = sanitizeFormString($_POST['firstName']);
		$lastName = sanitizeFormString($_POST['lastName']);
		$email = sanitizeFormString($_POST['email']);
		$email2 = sanitizeFormString($_POST['email2']);
		$password = sanitizeFormPassword($_POST['password']);
        $password2 = sanitizeFormPassword($_POST['password2']);
        
        $wasSuccesful = $account->register($username, $firstName, $lastName, $email, $email2, $password, $password2);
        
        if($wasSuccesful) {
            $_SESSION['userLoggedIn'] = $username;
            header("Location: index.php");
        }
	}
?>