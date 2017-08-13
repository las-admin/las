<?php

require_once "variables.php";

//connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//connection

function commentscount($id){
	global $conn, $commentstable;

	$id=$conn->real_escape_string(stripslashes($id));

	$sql = "SELECT DISTINCT comment FROM {$commentstable} WHERE postid = {$id}";
	$result = $conn->query($sql);
	return $result->num_rows;
}

?>