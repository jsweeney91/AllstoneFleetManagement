<?php
	if(isset($_GET['ID'])){
		$servername = "localhost";
		$username = "jsweeney91";
		$password = "Treehugger123!";
		$dbname = "allstone";

			// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		
		$sql = "select * from task where EMPLOYEE_ID =". $_GET['ID'];
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()){
			echo $row['CONTRACT_ID'];
		}
	}
?>
