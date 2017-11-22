<?php 
	require_once("dbconnection.php");
	if(isset($_GET["driver"])){
		if($_GET["driver"] !=""){			
			$sql = "SELECT e.code,e.first_name, e.last_name, l.email from employee e, login l where l.employee = e.code and code=".$_GET["driver"]; 
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {					
					echo'	<form action="scripts/addEmployee.php" method="post"><div class="form-group">
							<label for="first_name">First Name:</label>
							<input type="text" class="form-control" id="first_name" name="first_name" value="'.$row["first_name"].'">
							</div>
							<div class="form-group">
								<label for="last_name">Last Name:</label>
								<input type="text" class="form-control" id="last_name" name="last_name" value="'.$row["last_name"].'">
							</div>
							<div class="form-group">
								<label for="email">Email:</label>
								<input type="text" class="form-control" id="email" name="email" value="'.$row["email"].'">
							</div>
							<input type="hidden"  name="driver" value="'.$row["code"].'">
							<a type="button"  class="btn btn-default form-control" href="deleteDriver.php?id='.$row["code"].'" >Remove</a>
								<input type="submit"  class="btn btn-default form-control" value="submit"></input></form>';
				}
			}
		}		
}

?>