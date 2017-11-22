<?php 
	require_once('dbconnection.php');
	$contract = $_GET["contract"];
	$employee = $_GET["driver"];
	$start_time = $_GET["starttime"];
	$run_time = $_GET["runtime"];
	$site = $_GET["site"];
	$run_time = explode(" ",$run_time);
	$time = 0;
	if(count($run_time) == 2){
		$time = $run_time[0];
	}else if(count($run_time)==4){
		$time = ($run_time[0]*60)+$run_time[2];
	}

//	print_r($matches);
//	$time = ($matches[1][0]*60) +  $matches[2][0];
	$sql = "insert into task(CONTRACT_ID, EMPLOYEE_ID,START_TIME,RUN_TIME,SITE)VALUES((select contract_id from site where code = ".$contract."),".$employee.",'".$start_time."',".$time.",".$site.")";
	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	if ($conn->query($sql) === TRUE) {
		$continue = true;
		header("LOCATION: ../index.php");
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}	
?>