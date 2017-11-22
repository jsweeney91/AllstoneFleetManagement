<?php
	if(isset($_POST["inspection_date"])&&isset($_POST["details"])&&isset($_POST["vehicle"])){
		require_once("dbconnection.php");
		$details = str_replace("'", "\\'", $_POST["details"]);
		$sql = "insert into inspection(vehicle, inspection_date, comments) values (".$_POST["vehicle"].",'".$_POST["inspection_date"]."','".$details."')";
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		if ($conn->query($sql) === TRUE) {
			if(isset($_POST["activevehicle"])){
				
			}
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		if(!isset($_POST["activevehicle"])){
			$sql2 = "update vehicle set in_service=0 where code = ".$_POST["vehicle"];
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 
			if ($conn->query($sql2) === TRUE) {
				header("LOCATION: ../vehicleManagement.php");
			} else {
				echo "Error: " . $sql2 . "<br>" . $conn->error;
			}			
		
		}else{
			$sql2 = "update vehicle set in_service=1 where code = ".$_POST["vehicle"];
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 
			if ($conn->query($sql2) === TRUE) {
				header("LOCATION: ../vehicleManagement.php");
			} else {
				echo "Error: " . $sql2 . "<br>" . $conn->error;
			}			
		}	
	}
?>