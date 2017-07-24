<?php

require "variables.php";

//connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT DISTINCT day FROM {$tablename}";
$result = $conn->query($sql);
//connection

//days array
$days=array();
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		array_push($days, $row["day"]);
	}
}
//days array

$today=date("Y-m-d");
$todayindex=array_search($today, $days);

//Previous day means that it isn't necessarily yesterday,
//it is the last day somebody have posted.
//It is just easier to make than calculating a calendar.
if(count($days)>1){
	$previousday=$days[$todayindex-1];
} else {
	$previousday=$today;//There are only posts from today
}

?>