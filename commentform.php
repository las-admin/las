<head>
  <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<?php
$error="";//message displayed above the form to signal incorrect input.

//connection
require_once "variables.php";

//recaptcha
require "utility/recaptcha.php";
//recaptcha

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//connection

//post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  global $id, $conn, $commentstable;

  //getting posted values
  $user=$conn->real_escape_string(stripslashes($_POST["name"]));
  $comment=$conn->real_escape_string(stripslashes($_POST["comment"]));
  $postid=$conn->real_escape_string($_GET['id']);
  $id=$postid;
  //getting posted values

  //incorrect input handling
  $correct=true;

  if($user===""){
    $error.= "<br>You forgot the user name.";
    $correct=false;
  } 
  if($comment===""){
    $error.= "<br>You need to write something in the comment box.";
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
    $stmt = $conn->prepare("INSERT INTO {$commentstable} (username, comment, postid) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $user, $comment, $postid);
    if ($stmt->execute() === true) {
      echo "<script>window.location.replace('".htmlspecialchars("getpost.php?id=".$id)."');</script>";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    //post to the database
  }
}
//post
?>

<div class='panel panel-default' style='width:75%;'>
<div class='panel-heading'><h4 class='panel-title'>Your critique:</h4></div>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?id=".$id);?>" method="post">
  <?php 
    if($error!==""){
      echo "<div class='alert alert-warning'>
      <strong>Error:</strong>{$error}
      </div>";
    }
  ?>
  <input type="text" name="name" placeholder="Name"><br>
  <textarea name="comment" rows="4" cols="50" maxlength="2000"></textarea>
  <div class="g-recaptcha" data-sitekey="6Ld_WSoUAAAAAMbYQTuHc7WgJxGAsm__TL5NQvA4"></div>
  <input type="submit">
</form>
</div>