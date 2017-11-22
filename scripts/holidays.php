<?php 
	require_once("dbconnection.php");
	if(isset($_GET["driver"])){
		if($_GET["driver"] !=""){
			echo "<table class='table table-striped'>
			<thead>
			  <tr>
				<th>Start</th>
				<th>End</th>
				<th>Edit</th>
			</tr>
			</thead><tbody>";
			$sql = "SELECT h.code,e.first_name,e.last_name,h.start_date,h.end_date FROM holiday h, employee e where e.CODE = h.employee and e.code = ".$_GET["driver"]." and active = 1 order by h.start_date asc"; 
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td>".$row["start_date"]."</td>";
					echo "<td>".$row["end_date"]."</td>";
					echo "<td><input type ='button' class='form-group btn btn-default' onClick='removeHoliday(".$row["code"].")' value='Delete'></input></td>";
					echo "</tr>";
				}
			
			}
			echo "<tr>";
		echo '<td><input type="date" class="form-group"  id="start_date" name="start_date"></td>';
		echo '<td><input type="date" class="form-group"  id="end_date" name="end_date"></td>';
		echo "<td><input type ='button' class='form-group btn btn-default' onClick='addHoliday()' value='Add'></input></td>";
		echo "</tr>";
		}	
		
	
}

?>