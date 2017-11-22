<?php 
	require_once("dbconnection.php");
	if(isset($_POST["registration"])&&isset($_POST["payload"])){
		$sql = "insert into vehicle(registration, payload_size) values('".$_POST["registration"]."',".$_POST["payload"].")";
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		if ($conn->query($sql) === TRUE) {
			header("LOCATION: ../vehicleManagement.php?");
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}	
	}

?>