<?php
	if(isset($_POST["username"])&&isset($_POST["password"])){
		require_once("dbconnection.php");
		$sql = "select username, password,employee from login where username = '".$_POST["username"]."' and password = '".$_POST['password']."'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				session_start();
				$_SESSION["employee"] = $row["employee"];
				header("LOCATION: ../driverDashboard.php");
			}
		}else{
			
		}
	}
?>