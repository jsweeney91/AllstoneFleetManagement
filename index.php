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
				<h3>Jobs nearing deadline</h3>
				<?php
					require_once("scripts/dbconnection.php");
					
					$sql = "select s.address,s.contract_id, c.end_date,datediff(c.end_date,curdate()) as \"diff\", m.name,rm.quantity from site s, contract
					c, required_material rm, material m where c.code = s.contract_id and datediff(c.end_date,curdate()) <  5 and rm.material_code = m.code and rm.contract_code = c.code";
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
			<div id="vehicles">
					<table class='table table-striped'>
				<thead>
				  <tr>
					<th>Vehicle</th>					
					<th>Due date</th>
					<th>View</th>
				</tr>
				</thead><tbody>
				<h3>Vehicles nearing inspection date</h3>
				<?php
					require_once("scripts/dbconnection.php");
					
					$sql = "select v.registration,DATE_ADD(max(i.inspection_date), INTERVAL +6 WEEK) as \"duedate\" from inspection i, vehicle v where v.code = i.vehicle group by vehicle";
					$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {						
						$date1 = $row["duedate"];
						$date2 = date("Y/m/d");							 
						//Convert them to timestamps.
						$date1Timestamp = strtotime($date1);
						$date2Timestamp = strtotime($date2);
						$difference = $date1Timestamp - $date2Timestamp;
						$days = floor($difference / (60*60*24) );
						if($days<5){
							echo "<tr>";
							echo "<td>".$row["registration"]."</td>";
							echo $days."-";
							echo "<td>". date("d-M-Y", strtotime($row["duedate"]))."</td>";
							echo "<td><a type='button' class='form-group btn btn-default' href='vehiclemanagement.php'>view</a></td>";
							echo "</tr>";
						}
					}
				} 
				?>
				</tbody>
				</table>
			
			</div>
			<div id="staff">
			<table class='table table-striped'>
				<thead>
				  <tr>
					<th>Material</th>					
					<th>Start date</th>
					<th>End date</th>
				</tr>
				</thead><tbody>
				<h3>Near staff holidays</h3>
				<?php
					require_once("scripts/dbconnection.php");					
					$sql = "select e.first_name, e.last_name, h.start_date,h.end_date from employee e, holiday h where h.employee = e.code and 
					start_date < curdate()+5";
					$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {										
						echo "<tr>";
						echo "<td>".$row["first_name"]." ".$row["last_name"]."</td>";
						echo "<td>".date("d-M-Y", strtotime($row["start_date"]))."</td>";
						echo "<td>".date("d-M-Y", strtotime($row["end_date"]))."</td>";
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
