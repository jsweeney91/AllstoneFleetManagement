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
		<div id="alerts">
			<div id="jobs">
			<table class='table table-striped'>
				<thead>
				  <tr>
					<th>Material</th>
					<th>Address</th>
					<th>Information</th>
					<th>View</th>
				</tr>
				</thead><tbody>
				<h3>Today</h3>
				<?php
					require_once("scripts/dbconnection.php");
					
					$sql = "select ";
									$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
						
						echo "<tr>";
						echo "<td>".$row["quantity"]." tonnes of ".$row["name"]."</td>";
						echo "<td>".$row["address"]."</td>";
						if($row["diff"]<0){
							echo "<td>".$row["diff"]*-1 ." days overdue</td>";
						}else{
							echo "<td>".$row["diff"]." days remaining</td>";
						}
						echo "<td><a type='button' class='form-group btn btn-default' href='ordertracking.php?ID=".$row["contract_id"]."'>view</a></td>";
						echo "</tr>";
					}
				} 
				?>
				</tbody>
				</table>
			</div>
			
	

		</div>
		
			
	</body>
</html>
