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
			  <label for="companyName">Name:</label>
			  <input type="text" class="form-control" name="companyName">
			</div>
			<div class="form-group">
			  <label for="companyAddress">Address:</label>
			  <input type="text" class="form-control" name="companyAddress">
			</div>
			<div class="form-group">
			  <label for="companyPhone">Phone:</label>
			  <input type="text" class="form-control" name="companyPhone">
			</div>
		   <button type="submit" class="btn btn-default" name="addcustomer">Add</button>
		</form>	  
	</div>
	</body>
</div>