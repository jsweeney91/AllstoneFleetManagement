<?php
	require_once("dbconnection.php");
	if(isset($_GET["id"])&&isset($_GET["contract"])){
		$sql = "update task set complete = 1 where code = ".$_GET["id"];
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		if ($conn->query($sql) === TRUE) {
			header("LOCATION: ../ordertracking.php?ID=".$_GET["contract"]);
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}	
	}
	else if(isset($_GET["delete"])){
		$sql = "delete from task where code = ".$_GET["delete"];
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		if ($conn->query($sql) === TRUE) {
			header("LOCATION: ../ordertracking.php?ID=".$_GET["contract"]);
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}	
	}
	

?>