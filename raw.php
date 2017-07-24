<?php

require "variables.php";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT username, imagesource, tags, day, strike FROM {$tablename}";
$result = $conn->query($sql);

$delimeter=", ";

echo "You can parse this file by spliting it by '{$delimeter}'<br>";
echo "In each line words represent following: username, imagesource, tags, day, strike.<br>";
echo "If you want to backup this site, just copy it to your notepad and save it.<br><br>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo $row["username"].$delimeter.$row["imagesource"].$delimeter.$row["tags"].$delimeter.$row["day"].$delimeter.$row["strike"].$delimeter."</br>";
    }
}
?>