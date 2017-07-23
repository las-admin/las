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
<div class="panel panel-default col-sm-3">
<div class="panel-body">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <h2>Submit your artwork</h2>
    Name: <input type="text" name="name"><br>
    Image Link: <input type="text" name="name"><br>
    Tags: <input type="text" name="name"><br>
    <p class="small">*Your image link should end with image file extension, like ".jpeg" or ".png". 
    First upload it somewhere (tumblr, imgur, mixtape.moe), then right click on your image and select "Copy image adress".</p>
    <br>
    <input type="submit">
</form>
</div>
</div>
<?php

//connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "las";
/*$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}*/
//connection

//post message
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$base_url="http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/';
  echo "<script>window.location.replace('".$base_url."gallery.php');</script>";
}
//post message
?>

</body>
</html>
