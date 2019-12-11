<!-- disconnect from db -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scheduler";

$closeDB = mysqli_close(mysqli($servername, $username, $password, $dbname));

if(!$closeDB){
	die('Connection to DB failed') . mysqli_error($SDB);
}


?>
