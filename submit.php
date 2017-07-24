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
<?php
$error="";//message displayed above the form to signal incorrect input.

//connection
require "variables.php";
require "days.php";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//connection

function getstrike($username){
  global $tablename, $previousday, $conn;
  $sql = "SELECT strike FROM {$tablename} WHERE username='{$username}' AND day='{$previousday}'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    return $result->fetch_assoc()["strike"];
  } else {
    return 0;
  }
}

//post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //incorrect input handling
  if($_POST["name"]==="" || $_POST["image"]===""){
    if($_POST["name"]===""){
      $error.= "<br>You forgot the user name.";
    }
    if($_POST["image"]===""){
      $error.= "<br>You forgot the image link.";
    }
    //incorrect input handling
  }
  else{ 
    //post to the database
    $strike=getstrike($_POST["name"])+1;
    $sql = "INSERT INTO {$tablename} (username, imagesource, tags, day, strike)
    VALUES ('{$_POST["name"]}', '{$_POST["image"]}', '{$_POST["tags"]}', NOW(), '{$strike}')";
    if ($conn->query($sql) === TRUE) {
      //redirect
      echo "<script>window.location.replace('{$base_url}gallery.php');</script>";
      //redirect
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    //post to the database
  }
}
//post
?>
<div class="panel panel-default col-sm-3" style="margin-left:5px; margin-top:5px">
<div class="panel-body">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <h2>
      <a href="<?php echo $base_url ?>">
        <span class="glyphicon glyphicon-circle-arrow-left"></span></a>
      Submit your artwork
    </h2>
    <?php 
      if($error!==""){
        echo "<div class='alert alert-warning'>
        <strong>Incorrect input:</strong>{$error}
        </div>";
      }
    ?>
    Name: <input type="text" name="name"><br>
    Image Link: <input type="text" name="image"><br>
    Tags: <input type="text" name="tags"><br>
    <p class="small">*Your image link should end with image file extension, like ".jpeg" or ".png". 
    First upload it somewhere (tumblr, imgur, mixtape.moe), then right click on your image and select "Copy image adress".</p>
    <br>
    <input type="submit">
</form>
</div>
</div>
</body>
</html>
