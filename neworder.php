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
		var coords;
        var address = document.getElementById('AddressLine1').value+", "+document.getElementById('AddressLine2').value+", "+ document.getElementById('City').value;
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {			 
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: resultsMap,			  
              position: results[0].geometry.location
            });
			var confirm = document.getElementById('confirmation');
			confirm.innerHTML = '<p><b>Confirm address:</b></p><p> '+results[0].formatted_address+'</p> <a href="scripts/order.php?Pcoords='+results[0].geometry.location+'&Paddress='+results[0].formatted_address+'" type="button" class="btn btn-default" id="addConf" onClick="">confirm</button>';
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
		
      }
    </script>
	<style>
		#map {
			width:600px;
			height:250px;
		}
	</style>

</head>
	<body>
	<div class="container">

					<ul class="nav nav-pills">
		  <li><a href="index.php">Home</a></li>
		  <li class="active"><a href="#">Orders</a></li>
		  <li><a href="newordercustomer.php">New Order</a></li>
		  <li><a href="#">Menu 3</a></li>
		</ul>

			<h3>Collection point</h3>
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
			<div class='row'>
			<div class='col-sm-2'>
			 <div class="form-group">
				<label for="sel1">Site open</label>
				<select class="form-control" id="sel1">
			 <ul>
				  <option value='01'>01:00</option>
				  <option value='02'>02:00</option>
				  <option value='03'>03:00</option>
				  <option value='04'>04:00</option>
				  <option value='05'>05:00</option>
				  <option value='06'>06:00</option>
				  <option value='07'>07:00</option>
				  <option value='08' selected='true'>08:00</option>
				  <option value='09'>09:00</option>
				  <option value='10'>10:00</option>
				  <option value='11'>11:00</option>
				  <option value='12'>12:00</option>		
				</ul>
		    </select>
			</div>
			</div>
			<div class='col-sm-2'>
				<div class="form-group">
					<label for="sel2">AM/PM</label>

					<select class="form-control" id="sel2">
					<ul>				  
						<option value='11'>AM</option>
						<option value='12'>PM</option>		
					</ul>
		    </select>
			</div>
			</div>
			<div class='col-sm-2'>
			 <div class="form-group">
			<label for="sel3">Site closed</label>
			<select class="form-control" id="sel3">
			 <ul>
				  <option value='01'>01:00</option>
				  <option value='02'>02:00</option>
				  <option value='03'>03:00</option>
				  <option value='04'>04:00</option>
				  <option value='05'>05:00</option>
				  <option value='06'>06:00</option>
				  <option value='07'>07:00</option>
				  <option value='08' selected='true'>08:00</option>
				  <option value='09'>09:00</option>
				  <option value='10'>10:00</option>
				  <option value='11'>11:00</option>
				  <option value='12'>12:00</option>		
				</ul>
		    </select>
			</div>
			</div>
					<div class='col-sm-2'>
				<div class="form-group">	
				<label for="sel4">AM/PM</label>
					<select class="form-control" id="sel4">
					<ul>				  
						<option value='11'>AM</option>
						<option value='12'>PM</option>		
					</ul>
		    </select>
			</div>
			</div>
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
