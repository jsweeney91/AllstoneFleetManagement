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
	<h3>Driver Assignments</h3>
	<?php
		require_once("scripts/dbconnection.php");
		$sql = "select t.code,s.address,t.start_time from task t, site s where t.EMPLOYEE_ID = ".$_GET["id"]." and s.contract_id = t.CONTRACT_ID and t.complete = 0";
		$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		echo "<p>Driver has active tasks, these will be cancelled upon removal</p>";
	}else{
		echo "<p>Driver has no active tasks</p>";
	}
	?>
	<table class='table table-striped'>
	<thead>
      <tr>
        <th>Address</th>
        <th>Scheduled date</th>		
	</tr>
    </thead><tbody>
		<?php

			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo  "<td>".$row["address"]."</td>";
					echo  "<td>".$row["start_time"]."</td>";
					echo "</tr>";

				}
			}
		?>

	</table>
	<a type="button"  class="btn btn-default form-control" href="scripts/removeDriver.php?id=<?php echo $_GET["id"]?>" >Remove</a>
	</div>
	</body>
	</div>
