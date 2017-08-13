<?php

require_once "variables.php";
require_once "utility/htmlescape.php";

function getBreakText($t) {
    return strtr($t, array('\\r\\n' => '<br>', '\\r' => '<br>', '\\n' => '<br>'));
}

if( isset($_GET["id"]) && $_GET["id"] ) {

//connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id=$conn->real_escape_string($_GET['id']);

$sql = "SELECT username, comment FROM {$commentstable} WHERE postid = {$id}";
$result = $conn->query($sql);
//connection

if ($result!==null && $result->num_rows > 0) {
  $i=0;
  while($row = $result->fetch_assoc()) {
      echo comment($row["username"], $row["comment"]);
  }
} else {
    echo "No comments yet.";
}

}

function comment($username, $comment) {
	$username=htmlescape($username);
	$comment=getBreakText(htmlescape($comment));
	return "<div class='panel panel-default' style='width:75%;'>
        <div class='panel-heading'><h4 class='panel-title'><b>{$username}</b> commented:</h4></div>
         <div class='panel-body'>{$comment}</div>
</div>";
}

?>