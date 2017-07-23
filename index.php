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

<h1>Last Artist Standing</h1>

<hr>

<?php
$base_url="http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/';
echo "<a class='btn btn-info' role='button' href='".$base_url."submit.php'>Submit your artwork</a>";
echo "<hr>";
echo "<a class='btn btn-info' role='button' href='".$base_url."gallery.php'>Gallery</a>";
?>

<hr>

<p>Visit github repository page for more info:</p>

<a href="https://github.com/las-admin/las" target="_blank">https://github.com/las-admin/las</a>

<hr>

</body>
</html>
