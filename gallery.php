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

//stylised containers
$containerstart = ' <div class="container-fluid">';
$rowstart='  <div class="panel-body row" style="width:100%">';
function imagebox($username, $imagesource, $tags) {
	return "    <div class='col-sm-4'>
      <div class='panel panel-default'>
        <div class='panel-heading'><h3 class='panel-title'>{$username}</h3></div>
        <img src='{$imagesource}' class='img-responsive' style='width:100%' alt='{$imagesource}'>
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

$sql = "SELECT username, imagesource, tags, day, strike FROM {$tablename}";
$result = $conn->query($sql);

echo "<div class='panel panel-default'>
<div class='panel-heading'><h3 class='panel-title'>".date("Y/m/d")."</h3></div>
";
echo $containerstart;
if ($result->num_rows > 0) {
	$i=0;
	echo $rowstart;
    while($row = $result->fetch_assoc()) {
        echo imagebox($row["username"], $row["imagesource"], $row["tags"]);
        $i++;
        if($i%3==0 && $i!=$result->num_rows){
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
