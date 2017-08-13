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

<?php require"variables.php";?>

<h1>
	<a href="<?php echo $base_url ?>">
		<span class="glyphicon glyphicon-circle-arrow-left"></span></a>
Submissions
</h1>

<?php

require"days.php";
require "htmlescape.php";
require "commentscount.php";

//stylised containers
$containerstart = ' <div class="container-fluid">';
$rowstart='  <div class="panel-body row" style="width:100%">';
function imagebox($username, $imagesource, $tags, $streak, $id, $comments) {
	$username=htmlescape($username);
	$imagesource=htmlescape($imagesource);
	$tags=htmlescape($tags);
	$streak=htmlescape($streak);
	$id=htmlescape($id);
	global $base_url;
	return "    <div class='col-sm-3'>
      <div class='panel panel-default'>
        <div class='panel-heading'><h4 class='panel-title'><span class='text-primary'>#{$id}</span> <b>{$username}</b> - x{$streak} streak<br>
        <span class='text-muted'>{$comments} comments<span> </h4></div>
        <a href='".$base_url."getpost.php?id=".$id."'  target='_blank'>
       	<img src='{$imagesource}' class='img-responsive' style='width:100%; min-height: 150px;' alt='{$imagesource}'>
       	</a>
        <div class='panel-footer'>{$tags}</div>
      </div>
    </div>";
}
//stylised containers

//connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//connection
if(isset($_GET["user"]) && $_GET["user"]!==false) {
  $stmt = $conn->prepare("SELECT username, imagesource, tags, day, strike, id FROM {tablename} WHERE username = '{user}'");
  $stmt->bind_param('user', $_GET["user"]);
  $result = $stmt->execute();
}

function linktoday($index){
	return htmlspecialchars($_SERVER["PHP_SELF"]."?day=".$index);
}

//header with date and controls
echo "<div class='panel panel-default'>
<div class='panel-heading'><h3 class='panel-title'>";
echo "<p style='float:left; text-align: left; width:20%; display: inline-block;'>";//empty spans to keep the center text aligned
echo "</p>";
//echo "<p style='float:center; text-align: center; width:60%; display: inline-block;'>".$day."</p>";//center text
echo "<p style='float:right; text-align: right; width:20%; display: inline-block;'>";//empty spans to keep the center text aligned
echo "</p>";
echo"</h3></div>";
//header with date and controls

echo $containerstart;
if ($result->num_rows > 0) {
	$i=0;
	echo $rowstart;
    while($row = $result->fetch_assoc()) {
        echo imagebox($row["username"], $row["imagesource"], $row["tags"], $row["strike"], $row["id"], commentscount($row["id"]));
        $i++;
        if($i%4==0 && $i!=$result->num_rows){
        	//close the previous row and start a new one.
        	echo '</div>';
        	echo $rowstart;
        }
    }
    echo '</div>';
} else {
    echo "No images yet.";
}
echo '</div>';
echo '</div>';
?>

</body>
</html>
