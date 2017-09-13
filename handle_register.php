<?php

if($_GET['action'] == "register") {

	define('DB_HOST', 'localhost');
	define('DB_USER', 'student');
	define('DB_PASSWORD', 'circus');
	define('DB_NAME', 'react-backend');

	$firstName = $_POST["first_name"];
	$lastName = $_POST["last_name"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$passwordAgain = $_POST["password_again"];

	//check for blanks
	if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($passwordAgain)){
		die ("Please fill out all input fields.<br><a href='register.html'>Go back</a>");	
	}
	
	//check text input
	if (!is_string($firstName) || !is_string($lastName)) {
		die ("Please enter a valid name.<br><a href='index.html'>Go back</a>");
	}
	
	//check email
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	    die("Please enter a valid e-mail address.<br><a href='#'>Go back.<a/>");	
	}

	if ($password === $passwordAgain) {
		$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
	} else {
		echo "Please enter a matching password combination.";
	}

	echo "<a href='#'>Go back.<a/>";
	echo "<pre>";
		

	$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  	$result = mysqli_query($link,  "SELECT email FROM users");
    $row=mysqli_fetch_assoc($result);
	while( $row =mysqli_fetch_assoc($result)) {
   		if($row['email'] == $email) {
   			die('this email/ username is taken');
   		}

	 };
	mysqli_query($link, "INSERT INTO users (firstName, lastName, password, email) VALUE 
		('$firstName', '$lastName', '$password', '$email')");

}
?>
