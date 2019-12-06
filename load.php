<?php 
require_once('database/config.inc.php');
require_once('includes/session-functions.php');

//handle logins
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$login_status = $login->verify_login($_POST['email'], $_POST['password']);

	// if ($login_status == false){
	// 	include('login.php');
	// }
	// else{
	// 	include ('index.php');
	// }
}

// verify session
if ($login->verify_session()){
	$user = $login->user;
	include ('index-loggedin.php');
}
else{
	echo "<p>Session not verified</p>";
    include ('login.php');
}


?>