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
		<?php
			$site=0;
			require_once("scripts/dbconnection.php");
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
	
			$sql = "SELECT 
					m.name, rm.quantity, s.collection_flag,s.coordinates, s.address from 
					material m, required_material rm, site s where rm.Material_CODE = 
					m.CODE and 
					s.contract_id = rm.Contract_CODE and s.contract_id = ".$_GET["ID"];
					
			$result = $conn->query($sql);
			
			$quantity;
			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					$collect;
					if($row["collection_flag"]==1){
						$collect = "Collection of ";
					}else{
						$collect = "Delivery of ";
					}
					echo "<h3>Site</h3>";
					echo "<p>".$row["address"]."</p>";
					echo "<h3>Material</h3>";
					echo "<p>".$collect." ".$row["name"]."</p>";
					echo "<h3>Quantity</h3>";
					$quantity = $row["quantity"];
					echo "<p>".$row["quantity"]." Tonnes</p>";
				}
			} else {
				echo "0 results";
			}

	
			
						
									
		?>	

	
	<?php 
		$sql = "SELECT t.code,s.address, t.start_time, e.first_name, e.last_name, t.complete FROM site s, task t, employee e WHERE s.code = t.site AND t.employee_id = e.code and t.contract_id = ".$_GET["ID"];		
		$result = $conn->query($sql);
		$num_rows = mysqli_num_rows($result);
		$progress = (($num_rows*20)/$quantity)*100;
		echo '<h2>Progress</h2>
			  <div class="progress">
				<div class="progress-bar" role="progressbar" aria-valuenow="'.$progress.'" aria-valuemin="0" aria-valuemax="100" style="width:'.$progress.'%">
				  <span class="sr-only">.$progress.% Complete</span>
				</div>
			  </div>
		<table class="table table-striped">
				<thead>
				  <tr>
					<th>Driver</th>
					<th>Date</th>
					<th>Site</th>
					<th>Complete</th>
					<th>Mark as complete</th>
				</tr>
				</thead><tbody>';
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo "<tr>";
				echo "<td>".$row["first_name"]." ".$row["last_name"]."</td>";
				echo "<td>".$row["start_time"]."</td>";
				echo "<td>".$row["address"]."</td>";
				echo "<td>".$row["complete"]."</td>";
				echo "<td><a type='button' class='form-group btn btn-default'  href='scripts/orderupdate.php?id=".$row["code"]."&contract=".$_GET["ID"]."'>complete</a></td>";
				echo "</tr>";

			}
		} else {
			echo "0 results";
		}

	
	?>
	<style>
	#myProgress {
	  width: 100%;
	  background-color: #ddd;
	}

	#myBar {
	  width: <?php echo (($num_rows*20)/$quantity)*100; ?>%;
	  height: 30px;
	  background-color: #4CAF50;
	}
	</style>
	
	</tbody>
	</table>

	
	</div>
	
	</body>
</div>
