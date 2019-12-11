<!-- display previous & upcoming assignments -->
<?php
	session_start();
	require('dbconnect.php');
?>
<!DOCTYPE HTML>
<html>
<head>
</head>
<body>
	<?php
	
		$conn = new mysqli($servername, $username, $password, $dbname);
		
		if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    		header("location: login.php");
    		exit;
		}
		
		if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
		}
	
		if (isset($_POST['crsName'])) {
			$_SESSION['assignTMP'] = $_POST['crsName'];
		} else {
			$_POST['crsName'] = $_SESSION['assignTMP'];
		}
		echo("Assignments for " . $_POST['crsName'] . ":");
		
		$crsIDQuery = mysqli_query($SDB, "SELECT crsID FROM course WHERE crsName ='" . $_POST['crsName'] . "'");
		
		while($row = $crsIDQuery->fetch_assoc()) {
			$_SESSION['chosenCourseID'] = $row['crsID'];
		}
		
		function addAssign($descr, $dueDate, $DBAccess) {
			echo "<br>WORKS<br>";
			$sql = "INSERT INTO assignment (dueDate, descr, completed, crsID) VALUES ('" . $dueDate . "', '" . $descr  ."', 0,'" . $_SESSION['chosenCourseID'] . "')";
			$query = mysqli_query($DBAccess, $sql);
			//echo $sql;
		}
		
		function removeAssign($descr, $DBAccess) {
			$sqlR = "DELETE FROM assignment WHERE descr = ('" . $descr . "')";
			$queryR = mysqli_query($DBAccess, $sqlR);
			echo "<br>REMOVED";
		}
	?>
	<br>
	<button onclick="toggleAdd()">Add Assignment</button>
	<button onclick="toggleRemove()">Remove Assignment</button>
	<br><br>
	<div id="addAssignment" style="display: none;">
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
	Add Assignment: <br>
	Assignment Name: <input type="text" name="assignDesc" id="assign_Desc"><br>
	Due Date: <input type="text" name="assignDue" id="assign_Due"><br>
	<br>
	<input type="submit" name="submitAdd" value="Add">
	</form>
	<br>
	</div>
	<br>
	<div id="removeAssignment" style="display: none;">
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
	Remove Assignment:<br>
	Assignment Name: <input type="text" name="removeCourse" value="" id="remove_Course"><br>
	<br>
	<input type="submit" name="submitRemove" value="Remove">
	</form>
	</div>
	
	<div id="course_table">
	
	<table>
  <tr>
    <th>Description</th>
    <th>Due Date</th>
  </tr>
		<?php
			$ass_Query = mysqli_query($SDB, "SELECT descr, dueDate, crsID FROM assignment");
			while($row = $ass_Query->fetch_assoc()) {
				if ($row['crsID'] == $_SESSION['chosenCourseID']) {
					echo("  <tr>
    							<td>" . $row['descr'] . "</td>
    							<td>" . $row['dueDate'] . "</td>
  							</tr>"
  						);
  				}
			}
		?>
	</table>
	</div>
	<br><br><br>
	<form id='toHome' method='post' action='home.php'>
		<input type='submit' name='to_Home' value='Back'>
	</form>
	
	<?php
		if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['submitAdd'])) {
			addAssign($_POST["assignDesc"], $_POST["assignDue"], $conn);
			header("Refresh:0");
		} else if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['submitRemove'])) { 
			removeAssign($_POST["removeCourse"], $conn);
			header("Refresh:0");
		}
	?>
	
<script language="javascript">
function toggleAdd() {
  var x = document.getElementById("addAssignment");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
function toggleRemove() {
  var x = document.getElementById("removeAssignment");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>
</body>
</html>
