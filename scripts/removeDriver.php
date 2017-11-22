<?php
	require_once("dbconnection.php");
	$sql = "";
	if(isset($_GET["id"])){
		$sql = "delete from task where employee_id=".$_GET["id"];
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		if ($conn->query($sql) === TRUE) {
			$sql = "delete from employee where code=".$_GET["id"];
			if ($conn->query($sql) === TRUE){
				header("LOCATION: ../holidaymanagement.php");
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	
	}
	
?>