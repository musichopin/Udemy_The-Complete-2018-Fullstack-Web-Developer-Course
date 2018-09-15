<?php 

// Force the user to be logged in, or redirect. 
function ForceLogin() {
	if(isset($_SESSION['user_id'])) {
		// The user is allowed here  
	} else {
		// The user is not allowed here. 
		header("Location: /Udemy_The-Complete-2018-Fullstack-Web-Developer-Course/1a. Login Project without oop/login.php"); exit;
	}
}

function ForceDashboard() {
	if(isset($_SESSION['user_id'])) {
		// The user is allowed here but redirect anyway 
		header("Location: /Udemy_The-Complete-2018-Fullstack-Web-Developer-Course/1a. Login Project without oop/dashboard.php"); exit;
	} else {
		// The user is not allowed here. 
	}
}

?>