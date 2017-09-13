<?php

session_start();

$_SESSION['username'] = $_POST['email'];


define('DB_HOST', 'localhost');
define('DB_USER', 'student');
define('DB_PASSWORD', 'circus');
define('DB_NAME', 'react-backend');

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


if ($_GET['action'] == "login") {
	$email = $_POST['email'];
	$password = $_POST['password'];

	
	$query = "SELECT email, password FROM users where email='".$email."'";

	$queryResults = mysqli_query($link, $query);
	
	// print_r(mysql_fetch_array($link, $query));

	//check for blanks
	if (empty($email) || empty($password)){
		die ("Please fill out all input fields.<br><a href='register.html'>Go back</a>");
	}
	
	//check email
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	    die("Please enter a valid e-mail address.<br><a href='#'>Go back.<a/>");	
	}
	
	
	//password_verify($passwordResult, $_POST['password']);
	while ($row = mysqli_fetch_array($queryResults)) {
		
		$verifiedPass = password_verify($password, $row['password']);

		if ($row['email'] == $email && $verifiedPass ) {
			echo "ja works";
		}

		if($verifiedPass) {
			$_SESSION['loggedIn'] = true;
			//$_SESSION['username'] = true;
			echo $row['password'].' logged in ' .$password;
		} else {
			$_SESSION['loggedIn'] = false;
			echo ' kenneth sux LMAO ALSO THIS NEXT PART IS THE GODDAMN PASSWORD, *RACHEL* '.$password;
		}
	}	
		
}
?>
