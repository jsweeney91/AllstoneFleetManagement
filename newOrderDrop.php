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
	var coords;
    var address;
	function confirmClick(){
		var link = 'orderreview.php?collection='+document.getElementById('collectionFlag').checked+'&coords='+coords+'&address='+address;
		document.location.href = link;
	}
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: {lat: -34.397, lng: 150.644}
        });
        var geocoder = new google.maps.Geocoder();

        document.getElementById('submit').addEventListener('click', function() {
          geocodeAddress(geocoder, map);
        });
      }
	  	  
      function geocodeAddress(geocoder, resultsMap) {	
        address = document.getElementById('AddressLine1').value+", "+document.getElementById('AddressLine2').value+", "+ document.getElementById('City').value;
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {			 
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: resultsMap,			  
              position: results[0].geometry.location
            });
			res = results;
			coords = results[0].geometry.location;
			address = results[0].formatted_address;
			var confirm = document.getElementById('confirmation');
			confirm.innerHTML = '<p><b>Confirm address:</b></p><p> '+results[0].formatted_address+'</p> <a type="button" onClick="confirmClick()" class="btn btn-default" >confirm</button>';
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
		
      }
    </script>
	<style>
		#map {
			width:100%;
			height:400px;
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
			<h3>Drop point</h3>
			<div class="form-group">
			  <label for="AddressLine1">Address Line 1:</label>
			  <input type="text" class="form-control" id="AddressLine1">
			</div>
			<div class="form-group">
			  <label for="AddressLine2">Address Line 2:</label>
			  <input type="text" class="form-control" id="AddressLine2">
			</div>
			<div class="form-group">
			  <label for="City">City:</label>
			  <input type="text" class="form-control" id="City">
			</div>
			<div class="form-group">
				<label for="collectionFlag">Collection:</label>
				<input type="checkbox" id="collectionFlag"  />
			</div>
			<button type="submit" class="btn btn-default" id="submit">Get</button>
			<div id="map"></div>
			<div id="confirmation">
			
			</div>
			</div>
			<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuWekAKS0rPX1_xR1mbzKz8N3UJMJdjB0&callback=initMap">
			</script>
			
	</body>
</div>