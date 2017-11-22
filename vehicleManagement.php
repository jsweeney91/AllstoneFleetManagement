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
	<h3>Vehicle management</h3>
	<h4>Vehicles</h4>
	<table class='table table-striped'>
		<thead>
		  <tr>
			<th>Vehicle</th>
			<th>Next Inspection</th>
			<th>Inspections</th>

		</tr>
		</thead><tbody>		
		<?php
			require_once("scripts/dbconnection.php");
			$sql = "select code,registration,in_service from vehicle";
			
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {		
					echo  "<tr>";
					if($row["in_service"]==0){
						echo "<td class='vehicledanger'>".$row["registration"]."</td>";
					}else{
						echo "<td>".$row["registration"]."</td>";
					}
					$sql2 = "select DATE_ADD(max(inspection_date), INTERVAL +6 WEEK) as \"duedate\" from inspection where vehicle=".$row["code"]." limit 5";
					$result2 = $conn->query($sql2);
					if ($result2->num_rows > 0) {
						while($row2 = $result2->fetch_assoc()) {	
							$date1 = $row2["duedate"];
							$date2 = date("Y/m/d");							 
							//Convert them to timestamps.
							$date1Timestamp = strtotime($date1);
							$date2Timestamp = strtotime($date2);
							$difference = $date1Timestamp - $date2Timestamp;
							$days = floor($difference / (60*60*24) );
							if($days<1){
								echo "<td class='vehicledanger'>".$row2["duedate"]."</td>";
							}else if($days<7){
								echo "<td class='vehiclewarn'>".$row2["duedate"]."</td>";
							}else{
								echo "<td>".$row2["duedate"]."</td>";
							}
							
						}
					}		
					$sql2 = "select code,inspection_date from inspection where vehicle=".$row["code"]." order by inspection_date asc";
					$result2 = $conn->query($sql2);
					if ($result2->num_rows > 0) {
						while($row2 = $result2->fetch_assoc()) {	
							echo "<td><a href='inspection.php?id=".$row2["code"]."'>".$row2["inspection_date"]."</a><td>";
						}
					}
					echo "<td><a href='addInspection.php?id=".$row["code"]."' type='button' class='form-group btn btn-default'>Add</a></td>";

					echo "</tr>";
				}
			}
		?>
	</table>	
	
	<h3>Add Vehicle</h3>
	<form action="scripts/addVehicle.php" method="post">
	<div class="form-group">
		<label for="Registration">Registration:</label>
    <input type="text" class="form-control" name="registration" id="Registration">
	</div>
	  <div class="form-group">
		<label for="Payload">Payload Size:</label>
		<input type="text" name="payload" class="form-control" id="Payload">
	  </div>	 
	<input type="submit" class="btn btn-default form-control" value="submit"></input>
	</form>	
	</body>
	</div>
