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
	<script>
		function assign(){
			var runtime = document.getElementById('runtime').value;
			var site = document.getElementById('site').value;		
			var contract = document.getElementById('contract').value;
			var driver = document.getElementById('driver').value;
			var starttime = document.getElementById('starttime').value;
			window.location="scripts/schedule.php?starttime="+starttime+"&driver="+driver+"&runtime="+runtime+"&site="+site+"&contract="+contract;
		}
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
		<div id="map-canvas"></div>
			<script>
	function initMap() {
		<?php
			$site=0;
			require_once("scripts/dbconnection.php");
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			if(!isset($_GET["desired"])){
				session_start();
				$_SESSION["destinationCoord"] = $_GET["coords"];
				$_SESSION["destinationAddress"]=$_GET["address"];
				$_SESSION["collection"]=$_GET["collection"];

				$sql = "SELECT * FROM site where is_depot = 1";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
						if($_GET["collection"]=='false'){
							echo "pointA = new google.maps.LatLng".$row["Coordinates"].",";	
						}else{
							echo "pointB = new google.maps.LatLng".$row["Coordinates"].",";	
						}			  
					}
					//echo ""
				} else {
					echo "0 results";
				}
				$conn->close();
				if($_GET["collection"]=='false'){
					echo "pointB= new google.maps.LatLng".$_GET["coords"].",";
				}else{
					echo "pointA= new google.maps.LatLng".$_GET["coords"].",";
				}	
			//	echo "document.getElementById('confirm').html+='<a href=\"newordercustomer.php\"><button type=\"button\" class=\"btn btn-default\">Confirm</button></a>';";
			}else{
				$sql = "SELECT * FROM site where code =". $_GET["desired"]." or code =".$_GET["contract"];
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
						$site = $row["CODE"];
						$collection = true;
						if($row["collection_flag"]==1 ){
							echo "pointA = new google.maps.LatLng".$row["Coordinates"].",";	
						}else{
							echo "pointB = new google.maps.LatLng".$row["Coordinates"].",";	
							$collection = false;
						}		
												
					}
				} else {
					echo "0 results";
				}
				//echo "document.getElementById('confirm').html+='<a href=\"scripts/schedule.php\"><button type=\"button\" class=\"btn btn-default\">Confirm</button></a>';";

			}
						
									
		?>
		myOptions = {
		  zoom: 7,
		  center: pointA
		},
		map = new google.maps.Map(document.getElementById('map-canvas'), myOptions),
		// Instantiate a directions service.
		directionsService = new google.maps.DirectionsService,
		directionsDisplay = new google.maps.DirectionsRenderer({
		  map: map
		}),
		markerA = new google.maps.Marker({
		  position: pointA,
		  title: "point A",
		  label: "A",
		  map: map
		}),
		markerB = new google.maps.Marker({
		  position: pointB,
		  title: "point B",
		  label: "B",
		  map: map
		});

	  // get route from A to B
	  calculateAndDisplayRoute(directionsService, directionsDisplay, pointA, pointB);
	
	}



	function calculateAndDisplayRoute(directionsService, directionsDisplay, pointA, pointB) {
	  directionsService.route({
		origin: pointA,
		destination: pointB,
		travelMode: google.maps.TravelMode.DRIVING
	  }, function(response, status) {
		if (status == google.maps.DirectionsStatus.OK) {
		  directionsDisplay.setDirections(response);
		  document.getElementById('info').innerHTML += "<h2>Journey information(Each way)</h2>";
		  document.getElementById('info').innerHTML += "<h3>Duration</h3>"+response.routes[0].legs[0].duration.text;
		  document.getElementById('runtime').value = response.routes[0].legs[0].duration.text;
		  document.getElementById('info').innerHTML += "<h3>Distance</h3>"+response.routes[0].legs[0].distance.text;
		} else {
		  window.alert('Directions request failed due to ' + status);
		}
	  });
	}

	initMap();
	</script>
	<div id="info">
	
	</div>
	
	<div id="confirm">
	<?php if(isset($_GET["desired"])){
		echo "<button onClick='assign()' type=\"button\" class=\"btn btn-default\">Confirm</button></a>";
		echo "<input type='hidden' id='runtime'>";
		echo "<input type='hidden' value='".$_GET["driver"]."' id='driver'>";
		echo "<input type='hidden' value='".$site."'id='site'>";
		echo "<input type='hidden' value='".$_GET["contract"]."' id='contract'>";
		echo "<input type='hidden' value='".$_GET["starttime"]."' id='starttime'>";

	}else{
		echo "<a href=\"newordercustomer.php\"><button type=\"button\" class=\"btn btn-default\">Confirm</button></a>";
	}
	?>
	</div>
	
	
	</div>
	
	</body>
</div>
