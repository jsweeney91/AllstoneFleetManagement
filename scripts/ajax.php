<?php
	$servername = "localhost";
	$username = "jsweeney91";
	$password = "Treehugger123!";
	$dbname = "allstone";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	// Check connection
	if(isset($_POST["addBtn"])){
		if(isset($_POST["role_name"])&&isset($_POST["role_desc"])){
			if($_POST["role_name"]!=""){
				if($_POST["role_desc"]!=""){	
							
					$sql = "insert into role(name,description) values('".$_POST["role_name"]."','".$_POST["role_desc"]."')";
					
					if (mysqli_query($conn, $sql)) {
						echo "New record created successfully";
						header( 'Location: ../AddEmployee.php' ) ;
					} else {
						echo "Error: " . $sql . "<br>" . mysqli_error($conn);
					}

					
				}
			}
			
		}
	}
	if(isset($_POST["delRole"])){
		$sql = "delete from role where code =".$_POST['selectdropdown'];
		if (mysqli_query($conn, $sql)) {
			echo "Removed Role";
			header( 'Location: ../AddEmployee.php' ) ;
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
	
	if(isset($_POST["addMaterial"])){		
		$name = $_POST["materialName"];
		$description = $_POST["materialDesc"];
		$sql = "insert into material(name,description)values('".$name."','".$description."')";
		if (mysqli_query($conn, $sql)) {			
			header( 'Location: ../newOrder.php' ) ;
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
	
	if(isset($_POST["addcustomer"])){
		echo "hello";
		$phone = $_POST["companyPhone"];
		$name = $_POST["companyName"];
		$address = $_POST["companyAddress"];
		$sql = "insert into customer(name,address,phone)values('".$name."','".$address."','".$phone."')";
		if (mysqli_query($conn, $sql)) {			
			header( 'Location: ../newordercustomer.php' ) ;
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
	
	if(isset($_GET["coords"])){
		echo $_GET["coords"];
	}
	
?>