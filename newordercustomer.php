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
	
	<form action='scripts/order.php' method='POST'>
	
	<label for="customer">Customer</label>
		<div class = "row">
		<div class="col-sm-8">
		<select class="form-control" id="customer" name="customer" selected="1">
			<?php 
				session_start();
				
				$servername = "localhost";
				$username = "jsweeney91";
				$password = "Allstone123!";
				$dbname = "allstone";

				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection

				
				$sql = "SELECT code,name from customer";
				
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						echo  "<option value='".$row['code']."'>".$row['name']."</option>";
					}
				}
				echo '</select></div>';
				echo '<div class="col-sm-3"><a href="newcustomer.php" type="button" class="btn btn-success">New Customer</a></div></div>';
				echo '<label for="material">Material</label><div class="row"><div class="col-sm-8"><select class="form-control" id="material" name="material" selected="1">';
				$sql = "SELECT code,name from material";
				
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						echo  "<option value='".$row['code']."'>".$row['name']."</option>";
					}
				}
				echo '</select></div><div class="col-sm-3"><a href="newmaterial.php" type="button" class="btn btn-success">New Material</a></div></div>';
				echo '<input type="hidden" name="destinationCoord" value="'.$_SESSION["destinationCoord"].'">';
				echo '<input type="hidden" name="collection" value="'.$_SESSION["collection"].'">';
				echo '<input type="hidden" name="destinationAddress" value="'.$_SESSION["destinationAddress"].'">';
			?>
			
		
		<div class="row">
			<label for="quantity">Quantity(Tonnes):</label>
			<input type="text" class="form-control" id="quantity" name="quantity">
		</div>
		<div class="row">
			<label for="start">Start Date:</label>
			<input type="date" class="form-control" id="start" value="<?php echo date('Y-m-d'); ?>" name="start_date">
		</div>
		<div class="row">
			<label for="end">End Date:</label>
			<input type="date"  class="form-control" id="end" value="<?php echo date('Y-m-d'); ?>" name="end_date">
		</div>
		<button type="submit" class="btn btn-default" name="addBtn" id="submit">Submit</button>
		</div>
	</form>
	</body>
	</html>

		