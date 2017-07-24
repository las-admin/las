<!DOCTYPE html>
<html>

<head>
  <title>Last Artist Standing</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>

  </style>
</head>

<body>

<h1>Last Artist Standing</h1>

<hr>

<?php

require "variables.php";

$conn = new mysqli($servername, $username, $password);

if(!$conn->select_db($dbname)){
    $sql = "CREATE DATABASE {$dbname}";
	if ($conn->query($sql) === TRUE) {
		$conn->select_db($dbname);
	    $sql = "CREATE TABLE {$tablename} (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		username VARCHAR(30) NOT NULL,
		imagesource VARCHAR(100) NOT NULL,
		tags VARCHAR(100),
		day DATE,
		strike INT(6) UNSIGNED
		)";
		if ($conn->query($sql) === TRUE) {
		} else {
		    echo "Error creating table: " . $conn->error;
		}
	} else {
	    echo "Error creating database: " . $conn->error;
	}
}

echo "<a class='btn btn-info' role='button' href='{$base_url}submit.php'>Submit your artwork</a>";
echo "<br><br>";
echo "<a class='btn btn-info' role='button' href='{$base_url}gallery.php'>Gallery</a>";
?>

<hr>

<p>Visit github repository page for more info:</p>

<a href="https://github.com/las-admin/las" target="_blank">https://github.com/las-admin/las</a>

<hr>

</body>
</html>
