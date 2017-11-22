<?php
	$continue = false;
	$sql = "";
	require_once("dbconnection.php");
	
	if(isset($_GET["id"])&&isset($_GET["accept"])){
		$sql = "update holiday set active=1 where code=".$_GET["id"];
		$continue = true;
	}else	if(isset($_GET["id"])){
		$sql = "delete from holiday where code=".$_GET["id"];
		$continue = true;
	}else if(isset($_GET["driver"])&&isset($_GET["start_date"])&&isset($_GET["end_date"])){
		$sql = "insert into holiday(employee,start_date,end_date) values(".$_GET["driver"].",'".$_GET["start_date"]."','".$_GET["end_date"]."')";
		$continue = true;
	}
	if ($continue){
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		if ($conn->query($sql) === TRUE) {
			header("LOCATION: ../holidaymanagement.php");
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
?>