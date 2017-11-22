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
		<form action="scripts/ajax.php" method="POST">
			<div class="form-group">
			  <label for="sel1">Edit Role</label>
			  <select class="form-control" id="sel1" name="selectdropdown" selected="1">
				  <?php 
						$servername = "localhost";
						$username = "jsweeney91";
						$password = "Treehugger123!";
						$dbname = "allstone";

						// Create connection
						$conn = new mysqli($servername, $username, $password, $dbname);
						// Check connection

						
						$sql = "SELECT name,code from role";
						
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {

							while($row = $result->fetch_assoc()) {
								echo  "<option value='".$row['code']."'>".$row['name']."</option>";
							}
						}
					?>
			</select>			
	
			<button type="delete" class="btn btn-default" name="delRole" id="submit">Delete</button>
			</form>
			
			
			<div id="addnew">
				<form action="scripts/ajax.php" method="POST">
				<div class="form-group">
					<label for="role_name">Role Name:</label>
					<input type="text" class="form-control" id="role_name" name="role_name">
				</div>

				<div class="form-group">
					<label for="role_desc">Role Description:</label>
					<input type="text" class="form-control" id="role_desc" name="role_desc">
				</div>
				
				<button type="submit" class="btn btn-default" name="addBtn" id="submit">Add</button>
				</form>
			</div>
		</div>

	</body>
</html>