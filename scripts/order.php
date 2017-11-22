<?php
require_once('dbconnection.php');

if(isset($_POST["destinationAddress"])&& isset($_POST["destinationCoord"])&& isset($_POST["customer"])&& isset($_POST["material"])&& isset($_POST["quantity"])&&isset($_POST["start_date"])&&isset($_POST["end_date"])&&isset( $_POST["collection"])){
	$sql = "insert into contract(CUSTOMER_ID,START_DATE,END_DATE) values(".$_POST["customer"].",'".$_POST["start_date"]."','".$_POST["end_date"]."')";
	$continue = false;
	$contract=0;
	//echo $sql;
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	$result = $conn->query($sql);
	if ($conn->query($sql) === TRUE) {
		$contract = $conn->insert_id;
		$continue = true;
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	if($continue){
		$sql = "insert into required_material(Contract_code,Material_CODE,Quantity) values(".$contract.",".$_POST["material"].",".$_POST["quantity"].")";
		if ($conn->query($sql) === TRUE) {
			$continue = true;
			echo "yeah";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	$collect = 0;
	if($_POST["collection"]=='true'){
		$collect = 1;
	}
	$sql = "insert into site(address,coordinates,contract_id,collection_flag) values('".$_POST["destinationAddress"]."','".$_POST["destinationCoord"]."',".$contract.",".$collect.");";
	echo $sql;
	if ($conn->query($sql) === TRUE) {
		$continue = true;
		 header( 'Location: ../index.php' ) ;
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
}
?>
