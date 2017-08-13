<!DOCTYPE html>
<html>

<head>
  <title>LAS 2.0 Gallery</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
  $(function() {
    $( "li:contains('Gallery')" ).addClass("active"); 
  });
  </script>
  <style>
.image-header{
  margin-left:8px;
  margin-top:5px;
  margin-bottom:5px;
  line-height:1.2em
}
.image-tags{
  margin-left:8px;
  margin-top:5px;
  margin-bottom:5px;
}
.panel-default{
  margin-top:5px;
  margin-bottom:5px;
  border-radius:0;
}

  </style>
</head>

<?php require "header.php"; ?>

<body>



<?php

require_once"variables.php";
require"utility/days.php";
require "utility/htmlescape.php";
require "utility/commentscount.php";

//stylised containers
$containerstart = ' <div class="container-fluid"> <div class="panel-body row" style="width:100%;padding:2px">';
$rowstart='  <div class="col-sm-2" style="padding:2px">';
function imagebox($username, $imagesource, $tags, $streak, $id, $comments) {
	$username=htmlescape($username);
	$imagesource=htmlescape($imagesource);
	$tags=htmlescape($tags);
	$streak=htmlescape($streak);
	$id=htmlescape($id);
	global $base_url;
	return "<div class='panel panel-default'>
        <div class='image-header'><span class='text-primary'>#{$id}</span> <b>{$username}</b> - x{$streak} streak<br>
        <span class='text-muted'>{$comments} comments<span> </div>

        <a href='".$base_url."getpost.php?id=".$id."'  target='_blank'>
       	<img src='{$imagesource}' class='img-responsive' style='width:100%; min-height: 10em;' alt='{$imagesource}'>
       	</a>

        <div class='image-tags'>{$tags}</div>
      </div>";
}
//stylised containers

//connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//connection
if(isset($_GET["day"]) && $_GET["day"]!==false && is_numeric($_GET["day"]) && in_range($_GET["day"], $days)) {
	$dayindex=intval($_GET['day']);
	$day=$days[$dayindex];
} else {
	$dayindex=0;
	$day=$days[$dayindex];
}
$sql = "SELECT username, imagesource, tags, day, strike, id FROM {$tablename} WHERE day='".$day."'";
$result = $conn->query($sql);

function linktoday($index){
	return htmlspecialchars($_SERVER["PHP_SELF"]."?day=".$index);
}

//header with date and controls
echo "<h4>
<p style='float:left; text-align: left; width:20%; display: inline-block;'>";//empty paragraph to keep the center text aligned

if(in_range($dayindex+1, $days)){
	echo "<a href='".linktoday($dayindex+1)."'>
	<span class='glyphicon glyphicon-triangle-left'></span> ".$days[$dayindex+1]."</a>";
}

echo "</p>
<p style='float:center; text-align: center; width:60%; display: inline-block;'>".$day."</p>";//center text

echo "<p style='float:right; text-align: right; width:20%; display: inline-block;'>";//empty paragraph to keep the center text aligned
if(in_range($dayindex-1, $days)){
	echo "<a href='".linktoday($dayindex-1)."'>".$days[$dayindex-1]." 
<span class='glyphicon glyphicon-triangle-right'></span></a>";
}

echo "</p>
</h4>";
//header with date and controls

echo $containerstart;
if ($result->num_rows > 0) {
	$i=0;
  $columnCount=ceil($result->num_rows/6);
  $columnCount=$columnCount>0?$columnCount:1;
	echo $rowstart;
    while($row = $result->fetch_assoc()) {
        echo imagebox($row["username"], $row["imagesource"], $row["tags"], $row["strike"], $row["id"], commentscount($row["id"]));
        $i++;
        if($i%$columnCount==0 && $i!=$result->num_rows){
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

<?php require "footer.php"; ?>

</body>
</html>
