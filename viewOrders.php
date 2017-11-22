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
	<table class="table table-striped">
    <thead>
      <tr>
        <th>Contract ID</th>
        <th>Site</th>
        <th>Collection?</th>
		<th>Material</th>
		<th>View</th>
	</tr>
    </thead>
	<tbody>
		<?php 
			$servername = "localhost";
			$username = "jsweeney91";
			$password = "Treehugger123!";
			$dbname = "allstone";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection

			
			$sql = "select s.contract_id,c.code, s.address, s.collection_flag, m.name from contract c, required_material rm, material m, site s WHERE c.code = rm.Contract_CODE and rm.Material_CODE =  m.CODE and s.contract_id = c.CODE ";
			
			
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
				echo '<tr>';
					$collect="no";
					if($row["collection_flag"]==1){
						$collect = "yes";
					}
					echo  "<td>".$row["code"]."</td>";
					echo  "<td>".$row["address"]." </td>";
					echo  "<td>".$collect."</td>";
					echo  "<td>".$row["name"]."</td>";
					echo  "<td><a href='ordertracking.php?ID=".$row["contract_id"]."' type='Button' class='btn btn-default'>View</a></td>";
					
				echo "</tr>";
				}
			}
		?>
		</tbody>
		</table>

	
			

	</body>
</html>
