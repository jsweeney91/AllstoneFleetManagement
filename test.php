<?php

$servername = "localhost";
$username = "jsweeney91";
$password = "Treehugger123!";
$dbname = "allstone";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM site";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo $row["CODE"];
    }
} else {
    echo "0 results";
}
$conn->close();

?>