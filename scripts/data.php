<?php 
require_once("dbconnection.php");
if(isset($_GET["driver"]) && isset($_GET["date"])){
	$employee = $_GET["driver"];
	$starttime = $_GET["date"];
	$sql = "select * from holiday where '".$starttime."' between start_date and end_date and employee=".$employee;
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo "holiday scheduled between ".$row["start_date"]." and ". $row["end_date"];
		}
	}else{
		echo "<table id='scheduleinfo' class='table table-striped'>
		<thead>
		  <tr>
			<th>Address</th>
			<th>Start_time</th>
			<th>Run_time</th>
			<th>Edit</th>
		</tr>
		</thead><tbody>";
		$sql = "select time(t.start_time) as \"start_time\", s.address,t.run_time from site s, task t where t.employee_id=".$employee." and s.contract_id = t.contract_id
		and date(t.start_time) = '".$starttime."'";
		$result = $conn->query($sql);
		
		$coord;
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo "<tr>";
				echo  "<td>".$row["address"]."</td>";
				echo "<td>".$row["start_time"]."</td>";
				echo "<td>".$row["run_time"]."</td>";
				echo "<td><input type ='button' class='form-group btn btn-default' value='reschedule'></input></td>";				
				echo "</tr>";
			}
		}
		echo '<tr><td><input type="button" class="form-group btn" id="confirmbutton" onClick="clickEvt()" value="add"></input></td></tr>';

	}
}

?>