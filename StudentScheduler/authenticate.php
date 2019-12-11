<!-- authenticate login information and set session variables -->
<?php
	session_start();
	require("dbconnect.php");

	$postUser = $_POST['username'];
	$postPass = $_POST['password'];
?>
<!DOCTYPE HTML>
<html>
<head>

</head>
<body>
	<?php
	//confirm username & password combo exists in DB
	$query = mysqli_query($SDB, "SELECT count(*) as total FROM users WHERE username='$postUser' AND password='$postPass'");
	$data = mysqli_fetch_assoc($query);
	if($data){
		//Success
		if($data['total'] == 1){
			$_SESSION['username'] = $postUser;
			$query = mysqli_query($SDB, "SELECT userID, instrFlag FROM users WHERE username='$postUser'");
			$data = mysqli_fetch_assoc($query);
			
			//mark user as logged in
			$_SESSION['loggedin'] = true;
			
			$_SESSION['userID'] = $data['userID'];
			if($data['instrFlag'] == 0){
				$_SESSION['userType'] = "student";
			} else {
				$_SESSION['userType'] = "instructor";
			}
			header("Location: ./home.php");
		} else {
			header("Location: ./login.php");
		}
	} else {
		echo("Error: " . mysqli_error($SDB));
	}
	?>
</body>
</html>
