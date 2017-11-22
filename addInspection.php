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
 
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuWekAKS0rPX1_xR1mbzKz8N3UJMJdjB0"></script>


	
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
		<form action="scripts/addinspection.php" method="post">
			<input type="hidden" name="vehicle" value=<?php if(isset( $_GET["id"])){echo $_GET["id"];}?>>
			
			</input>
			<div class="row">
				<label for="inpection_date">Inspection Date:</label>
				<input type="date" class="form-group" id="inspection_date" name="inspection_date" ></input>
			</div>
			<div class="row">
				<label for="details">Inspection Comments:</label>
					<textarea class="form-control" rows="5" name="details" id="details"></textarea>
			</div>
			
			<div class="checkbox">
			<label class="checkbox-inline"><input name="activevehicle" type="checkbox" value="yes">Vehicle active</label>
			</div>
			<input type="submit" class="form-group btn btn-default"></input>
		</form>
	

	
	</div>
	
	</body>
</div>
