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
 		
  </script>
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
		
	<?php
		$regno;
		$in_service;
		$indate;
		$comments;
		$continue = false;
		require_once("scripts/dbconnection.php");
		if(isset($_GET["id"])){
			$sql = "select v.registration,v.in_service, i.inspection_date,i.comments from vehicle v, inspection i where i.vehicle = v.code and i.code=".$_GET["id"];
			
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {	
					$continue = true;				
					$regno=$row["registration"];
					if($row["in_service"]=="1"){
						$in_service = "Vehicle in service";
					}else{
						$in_service = "Vehicle not in service";
					}				
					$indate=$row["inspection_date"];
					$comments=$row["comments"];
				}
			}
		}
	
	?>
	<h2>Vehicle: <?php if($continue){echo	$regno; }?></h2>
	<p><b><?php if($continue){echo	$in_service; }?></b></p>
	<p><i>Inspection date: </i><?php if($continue){echo	$indate; }?></i></p>
	<p><i>Inspection Comments:</i> <br /><?php if($continue){echo	$comments; }?></p>
	<p></p>
	
	</body>
	</div>
