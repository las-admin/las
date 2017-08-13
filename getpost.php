<!DOCTYPE html>
<html>

<head>
  <title>LAS 2.0 Submission</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
	.footer{
		height:200px;
	}
  </style>
</head>

<body>

<div style="margin-left:5px;margin-top:5px;">
<?php

require "variables.php";
require "utility/htmlescape.php";

if( isset($_GET["id"]) && $_GET["id"]!==false && is_numeric($_GET["id"])) {

//connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id=intval($_GET['id']);

$sql = "SELECT username, imagesource, tags, day FROM {$tablename} WHERE id = {$id}";
$result = $conn->query($sql);
//connection

$row = $result->fetch_assoc();

echo imagebox($row["username"], $row["imagesource"], $row["tags"], $row["day"]);;

require "commentform.php";
require "getcomments.php";

}

function imagebox($username, $imagesource, $tags, $date) {
	$username=htmlescape($username);
	$imagesource=htmlescape($imagesource);
	$tags=htmlescape($tags);
	$date=htmlescape($date);
	return "
      <div class='panel panel-default' style='width:75%;'>
        <div class='panel-heading'><h4 class='panel-title'><b>{$username}</b> posted this image on {$date}:</h4></div>
        <a href='{$imagesource}'>
       	<img src='{$imagesource}' class='img-responsive' style='width:100%; min-height: 150px;' alt='{$imagesource}'>
       	</a>
        <div class='panel-footer'>{$tags}</div>
      </div>";
}

?>
<div class="footer"></div>
</div>

</body>
</html>