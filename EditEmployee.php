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
				  <?php 
				        if(isset($_GET['ID'])){							
							$servername = "localhost";
							$username = "jsweeney91";
							$password = "Treehugger123!";
							$dbname = "allstone";

							// Create connection
							$conn = new mysqli($servername, $username, $password, $dbname);
							// Check connection
							$sql = "SELECT first_name,last_name from employee where code =".$_GET['ID'];							
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									echo  "<h2>".$row["first_name"]." ".$row["last_name"]."</h2>";
							
									
								}
							}
							echo "<h3>Current Roles</h3>";
							echo  '<div class="form-group">';
							echo '<select multiple class="form-control" id="sel2"> ';
							$sql = "SELECT r.code,r.name from role r, employee e, employee_role er where e.code =".$_GET['ID']." and er. employee_id = e.code and r.code = er.job_role_id";							
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									echo "<option value=".row['code'].">". $row["name"]."</option>";
								}
							}
							echo "</select>";							
							echo "</div>";
							echo "<h3>Add Roles:</h3>";
							echo  '<div class="form-group">';
							echo '<select multiple class="form-control" id="sel2"> ';
							$sql = "SELECT code,name from role where code not in(select job_role_id from employee_role where employee_id =". $_GET["ID"].")" ;							
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									echo "<option value=".row['code'].">". $row["name"]."</option>";
								}
							}
							echo "</select>";							
							echo "</div>";
							
						}
					?>

				
		</div>

	</body>
</html>