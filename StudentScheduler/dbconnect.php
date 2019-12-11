<!-- connect to DB -->

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scheduler";
$SDB = @new mysqli($servername, $username, $password, $dbname);

if(!$SDB){
	die('Connection to DB failed') . mysqli_error($SDB);
}

?>
