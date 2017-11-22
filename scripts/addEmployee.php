<?php
	require_once("dbconnection.php");
	$continue=false;
	$sql="";
	$driver;
	if(isset($_POST["first_name"])&&isset($_POST["last_name"])&&isset($_POST["email"])){
		$first_name = $_POST["first_name"];
		$last_name = $_POST["last_name"];
		$email = $_POST["last_name"];
		$first_name = str_replace("'", "\\'", $first_name);
		$last_name = str_replace("'", "\\'", $last_name);
		$continue = true;
		if(!isset($_POST["driver"])){			
			$sql = "insert into employee(first_name, last_name) values('".$first_name."','".$last_name."')";
		}else{
			$driver=$_POST["driver"];
			$sql = "update employee set first_name='".$first_name."', last_name='".$last_name."' where code = ".$_POST["driver"];
		}
	}else{
		echo "hello";
	}
	echo $sql;
	if($continue){
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		if ($conn->query($sql) === TRUE) {
			$employee = $conn->insert_id;
			if(!isset($_POST["driver"])){
				$first_name = $_POST["first_name"];
				$last_name = $_POST["last_name"];
				$username = substr($first_name, 0,1);
				$username = $username . $last_name;		
				$password = "allstone123";
				$sql = "insert into login(email, username,password,employee) values('".$_POST["email"]."','".$username."','".$password."',".$employee.")";
				$count = 0;
				
				if ($conn->query($sql) === TRUE) {
				}else {
					while(true){
						$sql = "insert into login(email, username,password,employee) values('".$_POST["email"]."','".$username.$count."','".$password."',".$driver.")";
						if ($conn->query($sql) === TRUE) {
							break;
						}else{
							$count = $count +1;
						}
					}
					header("LOCATION: holidaymanagement.php");	
					echo "Error: " . $sql . "<br>" . $conn->error;
				}			
			}else{
				$sql = "update login set email='".$_POST["email"]."' where employee = ".$_POST["driver"];
				if ($conn->query($sql) === TRUE) {				
					header("LOCATION: ../holidaymanagement.php");	
				}else{
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
			}
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	//}
?>
