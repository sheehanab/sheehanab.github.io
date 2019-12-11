<!-- accept login information and send to authenticate.php -->
<?php
	session_start();
	//include("favicon.php");

	// Check if the user is logged in, if so then redirect to home page
	if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true){
    		header("location: home.php");
    		exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<div id="login_banner">
		<h1>Please Login</h1>
	</div>
	<div id="login_input">
		<form action="authenticate.php" method="post">
			Username<input type="text" name="username" value="" id="username"> <br>
			Password<input type="password" name="password" value="" id="password"> <br>
			<input type="submit" value="Login">
		</form>
	</div>
</body>
</html>
