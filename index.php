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

<div style="margin-left:5px;">
<?php

require "variables.php";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SHOW TABLES LIKE '{$tablename}'");
if ($result->num_rows == 0) {
    $sql = "CREATE TABLE {$tablename} (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	username VARCHAR(30) NOT NULL,
	imagesource VARCHAR(200) NOT NULL,
	tags VARCHAR(100),
	day DATE,
	strike INT(6) UNSIGNED
	)";
	if ($conn->query($sql) === FALSE) {
	    echo "Error creating table: " . $conn->error;
	}
}
?>

<h1>Last Artist Standing 2.0</h1>

<hr>

<a class='btn btn-info' role='button' href='<?php echo"{$base_url}submit.php"?>'>Submit your artwork</a>
<br><br>
<a class='btn btn-info' role='button' href='<?php echo"{$base_url}gallery.php"?>'>Submissions</a>
<br><br>
<a href='<?php echo"{$base_url}raw.php"?>' target="_blank">Raw Database Data</a>

<hr>

<p>Visit github repository page for more info:</p>

<a href="https://github.com/las-admin/las" target="_blank">https://github.com/las-admin/las</a>
</div>
</body>
</html>
