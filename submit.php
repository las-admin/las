<!DOCTYPE html>
<html>
<head>
  <title>LAS 2.0 Submit</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <script>
  $(function() {
    $( "li:contains('Submit')" ).addClass("active"); 
  });
  </script>
  <style>
  </style>
</head>

<?php require "header.php"; ?>

<body>
<?php
$error="";//message displayed above the form to signal incorrect input.

//connection
require_once "variables.php";
require "utility/days.php";
require "utility/recaptcha.php";
//recaptcha

//recaptcha

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

  //getting posted values

  $user=$conn->real_escape_string(stripslashes($_POST["name"]));
  $image=$conn->real_escape_string(stripslashes($_POST["image"]));
  $tags=$conn->real_escape_string(stripslashes($_POST["tags"]));
  $strike=getstrike($user)+1;
  //getting posted values

  //incorrect input handling
  $correct=true;
  $img_reg="#^.+\.(jpg|jpeg|png|bmp|gif)$#";
  $tags_reg="@^(#\w+ )*(#\w+ ?)?$@";

  if($user===""){
    $error.= "<br>You forgot the user name.";
    $correct=false;
  } 
  if($image===""){
    $error.= "<br>You forgot the image link.";
    $correct=false;
  }
  if(!preg_match($img_reg, $image)){
    $error.= "<br>Your image link must end with image file extension.";
    $correct=false;
  }
  if(!preg_match($tags_reg, $tags)){
    $error.= "<br>Tags are typed incorrectly, eg: #tag #tag2";
    $correct=false;
  }
  //incorrect input handling
  //recaptcha check
  if(!reCaptchaCheck($_POST["g-recaptcha-response"])){
    $error.= "<br>You need to solve the captcha.";
    $correct=false;
  }
  //recaptcha check
  if($correct){
    //post to the database
    $stmt = $conn->prepare("INSERT INTO {$tablename} (username, imagesource, tags, day, strike) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $user, $image, $tags, $today, $strike);
    if ($stmt->execute() === true) {
      echo "<script>window.location.replace('{$base_url}gallery.php');</script>";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    //post to the database
  }
}
//post
?>
<div class="col-sm-4"></div>
<div class="panel panel-default col-sm-4" style="margin-left:5px; margin-top:5px">
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
        <strong>Error:</strong>{$error}
        </div>";
      }
    ?>
    Name: <input type="text" name="name"><br>
    Image Link: <input type="text" name="image"><br>
    Tags: <input type="text" name="tags"><br>
    <p class="small">*Your image link should end with image file extension, like ".jpeg" or ".png". 
    First upload it somewhere (tumblr, imgur, mixtape.moe), then right click on your image and select "Copy image adress".</p>
    <div class="g-recaptcha" data-sitekey="6Ld_WSoUAAAAAMbYQTuHc7WgJxGAsm__TL5NQvA4"></div>
    <br>
    <input type="submit">
</form>
</div>
</div>
<div class="col-sm-4"></div>

<?php require "footer.php"; ?>

</body>
</html>
