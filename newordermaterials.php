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

			<h3>Material</h3>
			<form action="scripts/order.php" method="POST">
				<div class = "row">
				<div class="col-sm-8">
				<select class="form-control" id="sel1" name="materialDropdown" selected="1">
					<?php 
						$servername = "localhost";
						$username = "jsweeney91";
						$password = "Allstone123!";
						$dbname = "allstone";

						// Create connection
						$conn = new mysqli($servername, $username, $password, $dbname);
						// Check connection

						
						$sql = "SELECT code,name from material";
						
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								echo  "<option value='".$row['code']."'>".$row['name']."</option>";
							}
						}else{
							echo $conn->error;
						}
					?>
					</select>	
					</div>
					<div class="col-sm-4">
					 <a href="newmaterial.php" type="button" class="btn btn-success">Other</a>
					</div>
				</div>			
					<div class="form-group">
					  <label for="quantity">Quantity(Tonnes):</label>
					  <input type="text" class="form-control" name="quantityinput" id="quantity">
					</div>
					<button type="submit" class="btn btn-submit">Submit</button>			
			</form>
		</div>
	</body>
</html>
		
