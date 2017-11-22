<?php
	$servername="localhost";
	$username = "jsweeney91";
	$password = "Treehugger123!";
	$dbname = "allstone";

			// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	$sql = "insert into Workday()values()";
	for($i=0;$i<10000;$i++){
		if (mysqli_query($conn, $sql)) {			
			echo "added< br/>";
		}
	}
?>
