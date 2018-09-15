<?php 

	session_destroy();
	session_write_close();
	setcookie(session_name(),'',0,'/');
	session_regenerate_id(true);

	header("Location: /Udemy_The-Complete-2018-Fullstack-Web-Developer-Course/1a. Login Project without oop/index.php");

?>
