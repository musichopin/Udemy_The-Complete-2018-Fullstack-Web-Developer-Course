<?php 

	// Allow the config
	define('__CONFIG__', true);

	// Require the config
	require_once "../inc/config.php"; 

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		// Always return JSON format
		// header('Content-Type: application/json');

		$return = [];

		$email = Filter::String( $_POST['email'] );
		$password = $_POST['password'];

		// Make sure the user does not exist. 
		$findUser = $con->prepare("SELECT user_id, password FROM users WHERE email = LOWER(:email) LIMIT 1");
		$findUser->bindParam(':email', $email, PDO::PARAM_STR);
		$findUser->execute();

		if($findUser->rowCount() == 1) { // vers1
			// User exists, try and sign them in
			$User = $findUser->fetch(PDO::FETCH_ASSOC);

			$user_id = (int) $User['user_id'];
			$hash = (string) $User['password'];

			if(password_verify($password, $hash)) {
				// User is signed in
				$return['redirect'] = '/Udemy_The-Complete-2018-Fullstack-Web-Developer-Course/1a. Login Project without oop/dashboard.php';

				$_SESSION['user_id'] = $user_id;
				$_SESSION['email'] = $email;
			} else {
				// Invalid user email/password combo
				$return['error'] = "Invalid user email/password combo";
			}

		} else {
			// They need to create a new account
			$return['error'] = "You do not have an account. <a href='/Udemy_The-Complete-2018-Fullstack-Web-Developer-Course/1a. Login Project without oop/register.php'>Create one now?</a>";
		}

		echo json_encode($return, JSON_PRETTY_PRINT); exit;
	} else {
		// Die. Kill the script. Redirect the user. Do something regardless.
		exit('Invalid URL');
	}
?>

<!-- 
vers1:

$User = $findUser->fetch(PDO::FETCH_ASSOC);
if($User) { 
-->