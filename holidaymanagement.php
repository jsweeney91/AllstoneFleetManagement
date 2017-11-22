<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <link rel="stylesheet" href="styles/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
  	function getSchedule(id) {
		document.getElementById("myStyle").html = "";
		var driver = document.getElementById('driver').value;
		$('#myStyle').load('scripts/holidays.php?driver='+driver);
	}
	function getDriverInfo() {
		var driver = document.getElementById('updateDriver').value;
		$('#employeeInfo').load('scripts/updateDriver.php?driver='+driver);
	}
	
	function refreshSchedule(id) {
		alert("Completed");
		var info = document.getElementById('myStyle');
		info.html = "";
		$('#myStyle').load('scripts/holidays.php?driver='+id);
	}
	function removeHoliday(id) {
		var driver = document.getElementById('driver').value;
		$('#myStyle').load('scripts/removeHoliday.php?id='+id);
		refreshSchedule(driver);
		  
	}
	function addHoliday() {
		var info = document.getElementById("myStyle");
		var driver = document.getElementById('driver').value;
		var start_date = document.getElementById('start_date').value;
		var end_date = document.getElementById('end_date').value;
		$('#myStyle').load('scripts/removeHoliday.php?driver='+driver+"&start_date="+start_date+"&end_date="+end_date);
		refreshSchedule(driver);
		  
	}
	function addEmployee() {
		var first_name = document.getElementById('first_name').value;
		var last_name = document.getElementById('last_name').value;
		window.location ="scripts/addEmployee.php?first_name="+first_name+"&last_name="+last_name;
		  
	}
	function holidayRequest(id, respond) {
		if(respond==false){
			window.location ="scripts/removeHoliday.php?id="+id;
		}else{
			window.location ="scripts/removeHoliday.php?id="+id+"&accept=true";
		}
		
		  
	}
		
  </script>
</head>
<body>
<div class="container">

<?php 
			require_once("scripts/dbconnection.php");
?>
	<nav class="navbar navbar-default">
		  <div class="container-fluid">
			<div class="navbar-header">
			  <a class="navbar-brand" href="#">Allstone Glasgow</a>
			</div>
			<ul class="nav navbar-nav">
			  <li><a href="neworderdrop.php">New order</a></li>
			  <li><a href="scheduleDriver.php">Assign orders</a></li>
			  <li><a href="holidaymanagement.php">Driver management</a></li>
			  <li><a href="viewOrders.php">Orders</a></li>
			   <li><a href="vehicleManagement.php">Vehicles</a></li>
			</ul>
		  </div>
		</nav>
	<h3>Holiday management</h3>
	<h4>Holiday requests</h4>
	<?php
		echo "<table id='scheduleinfo' class='table table-striped'>
		<thead>
		  <tr>
			<th>Employee</th>
			<th>Start date</th>
			<th>End date</th>
			<th>Comments</th>
			<th>Confirm</th>
			<th>Reject</th>
		</tr>
		</thead><tbody>";
		$sql = "select h.code,e.first_name, e.last_name, h.start_date,h.end_date, h.comments from holiday h, employee e where e.code=h.employee and active = 0";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo "<tr>";
				echo  "<td>".$row["first_name"]." ".$row["last_name"]."</td>";
				echo "<td>".$row["start_date"]."</td>";
				echo "<td>".$row["end_date"]."</td>";
				echo "<td>".$row["comments"]."</td>";
				echo "<td><input type='button' class='form-group btn btn-default' value='confirm' onclick='holidayRequest(".$row["code"].",true)'></input></td>";	
				echo "<td><input type='button' class='form-group btn btn-default' value='reject' onclick='holidayRequest(".$row["code"].",false)'></input></td>";					
				echo "</tr>";
			}
		}
		echo "</tbody></table>";
	?>
	<h4>Add Holidays</h4>
	<select class="form-control" onChange="getSchedule()" id="driver" name="driver" selected="1">
		<option></option>
		<?php
			$sql = "select code, first_name,last_name from employee";
			
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
				echo  "<option value='".$row["code"]."'>".$row["first_name"]." ".$row["last_name"]."</option>";
				}
			}
		?>
	</select>	
	<div id="myStyle">
	</div>
	<h3>Add Employee</h3>
	<form action="scripts/addEmployee.php" method="post">
	<div class="form-group">
		<label for="first_name">First Name:</label>
    <input type="text" class="form-control" name="first_name" id="first_name">
	</div>
	  <div class="form-group">
		<label for="last_name">Last Name:</label>
		<input type="text" name="last_name" class="form-control" id="last_name">
	  </div>
	  <div class="form-group">
		<label for="email">Email:</label>
		<input type="text" name="email" class="form-control" id="email">
	  </div>
	<input type="submit" class="btn btn-default form-control" value="submit"></input>
	</form>
	<h3>Edit Driver</h3>
	<select class="form-control" onChange="getDriverInfo()" id="updateDriver" name="updateDriver" selected="1">
		<option></option>
		<?php
			require_once("scripts/dbconnection.php");
			$sql = "select code, first_name,last_name from employee";
			
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
				echo  "<option value='".$row["code"]."'>".$row["first_name"]." ".$row["last_name"]."</option>";
				}
			}
		?>
	</select>
	<div id="employeeInfo">
	</div>	
	</body>
	</div>
