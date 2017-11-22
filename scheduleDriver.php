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
			var driver = document.getElementById('driver').value;
			var date = document.getElementById('start_date').value;
		    $('#myStyle').load('scripts/data.php?driver='+driver+'&date='+date);
		}
		
		function clickEvt(){
			var driver = document.getElementById('driver').value;
			var contract = document.getElementById('contract').value;
			var starttime = document.getElementById('start_time').value;
			var startdate = document.getElementById('start_date').value;
			starttime = startdate + " "+starttime;

			window.location = "orderAssign.php?contract="+contract+"&driver="+driver+"&starttime="+starttime;
		}
	
	</script>

	<style>
	 html,
    body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
    #map-canvas {
      height: 500px;
      width: 100%;
    
    }
	</style>

</head>
	<body>	
		<div class="container">
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
			<h3>Select Driver</h3>
			<select class="form-control" onChange="getSchedule()" id="driver" name="driver" selected="1">
				<?php
					require_once('scripts/dbconnection.php');
					$sql = "select code, first_name, last_name from employee";
					$result = $conn->query($sql);
					$count = 0;
					$coord;
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							echo "<option value='".$row["code"]."'>".$row["first_name"]." ".$row["last_name"]."</option>";
						}
					}
					echo '</select><h3>Select contract</h3><select class="form-control" id="contract" name="contract" selected="1">';
					$sql = "select s.code,s.contract_id,s.address from site s where is_depot = 0";
					$result = $conn->query($sql);
					$count = 0;
					$coord;
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							echo "<option value='".$row["code"]."'>".$row["address"]."</option>";
						}
					}

				?>
				
			</select>
			<h3>Start Time</h3>
			<input type="date" class="form-group" onChange="getSchedule()"  id="start_date" name="start_date">

			  <input type="time" class="form-group" id="start_time" name="start_time">
			<div id="myStyle">
		
		</div>
		</div>
		
	
	</body>
</div>
