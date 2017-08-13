<!DOCTYPE html>
<html>

<head>
  <title>Last Artist Standing</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
  $(function() {
    $( "li:contains('Home')" ).addClass("active"); 
  });
  </script>
  <style>

  </style>
</head>

<?php require "header.php"; ?>

<body>

<?php

require_once "variables.php";

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
$result = $conn->query("SHOW TABLES LIKE '{$commentstable}'");
if ($result->num_rows == 0) {
    $sql = "CREATE TABLE {$commentstable} (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	username VARCHAR(30) NOT NULL,
	comment VARCHAR(2000) NOT NULL,
	postid INT(6) UNSIGNED
	)";
	if ($conn->query($sql) === FALSE) {
	    echo "Error creating table: " . $conn->error;
	}
}
?>

<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-3">
    </div>
    <div class="col-sm-6 text-left"> 

<h2>Last Artist Standing 2.0</h2>
Draw everyday longer than anyone else.
<br><br>

Original Site:<br><a href="http://www.lavaflake.com/draw/" target="_blank">http://www.lavaflake.com/draw/</a>

<br>Alternative 1:<br><a href="http://las2.esy.es/" target="_blank">http://las2.esy.es/</a>
<br>Alternative 2:<br><a href="https://drawing.today/" target="_blank">https://drawing.today/</a>
<br>
<br>
Rules
<br>
<span class="quote">&gt;Update every day at your prefered LAS site or all of them.</span>
<br><span class="quote">&gt;The deadline for submissions is 23:59:59 GMT each day</span>
<br><span class="quote">&gt;You should spend at least 30 minutes on each update</span>
<br><span class="quote">&gt;Miss another day within a month and you're eliminated.</span>
<br><span class="quote">&gt;Progress updates are ok but they will be policed like other submissions</span>
<br><span class="quote">&gt;Please refrain from drawing sexual encounters with under age humans.</span>
<br><span class="quote">&gt;Have fun.</span>
<br>
<br>
/ic/ guides:
<br>
<a href="http://www.squidoo.com/how-to-draw-learn">One-Stop Beginners' Guide</a>
<br><a href="https://sites.google.com/site/ourwici/">The w/ic/i</a>
<br><br>
/las/ thread:
<br><a href='http://boards.4chan.org/ic/catalog#s=/las/' target='_blank'>http://boards.4chan.org/ic/catalog#s=/las/</a>
<br><br>
The official discord:
<br>
<a href='https://discord.gg/atc5REB' target='_blank'>https://discord.gg/atc5REB</a>
<br><br>
This is a library of resources some users have made for the community:
<br>
<a href='https://drive.google.com/open?id=0B3GiCtv0swalbDRCN1FYNVExWk0' target='_blank'>https://drive.google.com/open?id=0B3GiCtv0swalbDRCN1FYNVExWk0</a>
<br><br>
This is the /las/ list of inspirational artists:
<br>
<a href='https://docs.google.com/spreadsheets/d/1TjFiWtqoAxSCqGH0Z_YJT3tQInZvgxVoNBlJamh1AI8/edit#gid=0' target='_blank'>https://docs.google.com/spreadsheets/d/1TjFiWtqoAxSCqGH0Z_YJT3tQInZvgxVoNBlJamh1AI8/edit#gid=0</a>
<br><br>
Copy text from this page to backup this site:
<br>
<a href='<?php echo"{$base_url}raw.php"?>'>/raw.php</a>

    </div>
    <div class="col-sm-3">
    </div>
  </div>
</div>

<?php require "footer.php"; ?>

</body>
</html>