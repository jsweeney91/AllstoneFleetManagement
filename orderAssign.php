<!DOCTYPE html>
<html> 
<head> 
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <link rel="stylesheet" href="styles/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuWekAKS0rPX1_xR1mbzKz8N3UJMJdjB0"></script>

 <script>
  function clickEvt(){
	  var link = document.getElementById("site").value;
	  var link2 ="driver=<?php echo $_GET["driver"]."&contract=".$_GET["contract"]?>";
	  
	  window.location="orderreview.php?starttime=<?php echo $_GET["starttime"]; ?>&"+link+"&"+link2;
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
  <h3>Sites available</h3>
  <div id="map" style="width: 100%; height: 600px;"></div>

  <script type="text/javascript">
    var locations = [
	<?php
		$coord;
	    if(isset($_GET["contract"])){
			$site = $_GET["contract"];
			require_once('scripts/dbconnection.php');
			$sql = "SELECT
				s.code,
				s.address,
				s.coordinates
			FROM
				site s,
				required_material rm,
				material m
			WHERE
				rm.Contract_CODE = s.contract_id
				AND rm.Material_CODE = m.code
				and is_depot != 1
				and rm.Material_CODE =(select material_code from required_material where contract_code=(select contract_id from site where code = ".$site."))
				 AND s.code != ".$site." AND s.collection_flag !=(
				SELECT
					collection_flag
				FROM
					site
				WHERE CODE
					= ".$site."
			)";
						$result = $conn->query($sql);
			$count = 0;
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$coord = substr($row["coordinates"], 1, -1);
					echo "['".$row["address"]."',".$coord.",".$count."],";
					$count++;
				}
			}
			$sql = "select address, coordinates from site where is_depot = 1 and collection_flag != (SELECT collection_flag FROM site WHERE CODE	= ".$site.")";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$coord = substr($row["coordinates"], 1, -1);
					echo "['".$row["address"]."',".$coord.",".$count."],";
				}
			}
		}
	?>     
    ];

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 9,
      center: new google.maps.LatLng(<?php echo $coord ?>),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  </script>
  <h3>Select site</h3>
  <select class="form-control" id="site" name="site" selected="1">
  <?php
		if(isset($_GET["contract"])){
		$sql = "select contract_id from site where code = ".$_GET["contract"];
		$contract_code;
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$contract_code = $row["contract_id"];
			}
		}
		require_once('scripts/dbconnection.php');
		$sql = "select s.code,s.collection_flag,s.contract_id, s.address from site s, required_material rm 
				where 
				rm.Contract_CODE = s.contract_id and 
				rm.Material_CODE = (select Material_CODE from required_material where contract_code = ".$contract_code.") and 
				contract_code != ".$site." and
				s.collection_flag != (select collection_flag from site where code = ".$site.")";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo "<option value='desired=".$row["code"]."&collection=".$row["collection_flag"]."'>".$row["address"]."</option>";
			}
		}
		$sql = "select code,address, coordinates,collection_flag from site where is_depot = 1 and collection_flag != (SELECT collection_flag FROM site WHERE CODE	= ".$site.")";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {			
				echo "<option value='desired=".$row["code"]."&collection=".$row["collection_flag"]."'>".$row["address"]."</option>";

			}
		}
	}
	
	?>
  </select>
  
  <input type="submit" class="form-group btn-default" value="Submit" onClick="clickEvt()"></input>
  </div>
</body>
</html>