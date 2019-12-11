<!-- display courses -->
<?php
	session_start();
	require('dbconnect.php');
	// Check if the user is logged in, if not then redirect to login page
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    		header("location: login.php");
    		exit;
	}
?>

<!DOCTYPE HTML>
<html>
<head>
	<?php echo("<title>" . $_SESSION["username"] . "'s Homepage</title>"); ?>
</head>
<body>
	<?php
	
		$conn = new mysqli($servername, $username, $password, $dbname);
	
		echo($_SESSION['username'] . "<br>" . $_SESSION['userType'] . "<br><br>");
		$idArr = array();
		$query = mysqli_query($SDB, "SELECT enID, crsID FROM enrolled WHERE userID='" . $_SESSION['userID'] . "'");
		while($data = mysqli_fetch_assoc($query)){
			$idArr[$data['enID']] = $data['crsID'];
		}
		$crs_query = mysqli_query($SDB, "SELECT crsName FROM course WHERE crsID IN (" . implode(', ', $idArr) . ")");
		echo("Enrolled courses for " . $_SESSION['username'] . ": <br>");
		$crsArr = array();
		while($crs_data = mysqli_fetch_assoc($crs_query)){
			$crsArr[] = $crs_data['crsName'];
		}
		
		function addCourse($courseID, $creditHrs, $name, $semester, $year, $time, $days, $DBAccess) {
			echo "<br>WORKS<br>";
			$sql = "INSERT INTO course (crsID, InstructorId, creditHours, crsName, semester, year, time, days) VALUES (" . $courseID . " ,1 , " . $creditHrs . " , '" . $name  ."', '" . $semester  ."', " . $year . ", '" . $time . "', '" . $days  ."')";
			$sql2 = "INSERT INTO enrolled (crsID, userID) VALUES (" . $courseID . ", " . $_SESSION['userID']. ")";
			$query = mysqli_query($DBAccess, $sql);
			$query2 = mysqli_query($DBAccess, $sql2);
			//echo $sql;
		}
		
		function removeCourse($course_name, $DBAccess) {
			$idQuery = "SELECT crsID FROM course where crsName = '" . $course_name . "'";
			$course_id = mysqli_query($DBAccess, $idQuery);
			while ($row = $course_id->fetch_assoc()) {
				$sqlR = "DELETE FROM enrolled WHERE crsID = ('" . $row['crsID'] . "') AND userID = ('" . $_SESSION['userID'] . "')";
				$queryR = mysqli_query($DBAccess, $sqlR);
			}
			echo "<br>REMOVED";
		}
		?>
	<div id="course_table">
		<?php
			foreach($crsArr as $item){
				echo("<form id='" . $item . "' method='post' action='assignments.php'>");
				//echo("<input type='hidden' name='crsName' value='" . $item . "'>");
				echo("<input type='submit' name='crsName' value='" . $item . "'>");
				echo("</form>");
			}
		?>
	</div>
	<br>
	<button onclick="toggleSettings()">Settings</button>
	<br><br>
	
	<div id="settings" style="display: none;">
		<button onclick="toggleAdd()">Add Course</button>
		<button onclick="toggleRemove()">Remove Course</button>
		<div id="addCourseDiv" style="display: none;">
			<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
				<br>Add Course: <br>
				Course Name: <input type="text" name="courseName" id="course_Name"><br>
				Course ID: <input type="text" name="courseID" id="course_ID"><br>
				Credit Hours: <input type="text" name="courseHrs" id="course_Hrs"><br>
				Semester: <input type="text" name="courseSemester" id="course_Semester"><br>
				Year: <input type="text" name="courseYear" id="course_Year"><br>
				Time: <input type="text" name="courseTime" id="course_Time"><br>
				Days: <input type="text" name="courseDays" id="course_Days"><br>
				<br>
				<input type="submit" name="submitAdd" value="Add">
			</form>
		</div>
		
		<div id="removeCourseDiv" style="display: none;">
			<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
				<br>Remove Course: <br>
				Course Name: <input type="text" name="courseName" id="course_Name"><br>
				<br>
				<input type="submit" name="submitRemove" value="Remove">
			</form>
		</div>
	</div>
	
	<div id="home_footer">
		<br>
		<form id="logout_button" action="logout.php">
			<input type="submit" name="logout" value="Logout"/>
		</form>
	</div>
	
		<?php
		if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['submitAdd'])) {
			addCourse($_POST["courseID"], $_POST["courseHrs"], $_POST["courseName"], $_POST["courseSemester"], $_POST["courseYear"], $_POST["courseTime"], $_POST["courseDays"], $conn);
			//header("Refresh:0");
		} else if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['submitRemove'])) { 
			removeCourse($_POST["courseName"], $conn);
			//header("Refresh:0");
		}
	?>
	
<script language="javascript">
function toggleSettings() {
  var x = document.getElementById("settings");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

function toggleAdd() {
  var x = document.getElementById("addCourseDiv");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

function toggleRemove() {
  var x = document.getElementById("removeCourseDiv");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>
</body>
</html>
