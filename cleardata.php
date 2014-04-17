<!DOCTYPE html>
<html>
<body>

<h1></h1>


<?php

$link=mysqli_connect("localhost", "root", "123", "my_db");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
  }
else
  {
  echo "Connection successful<br>";
  }


$sql = "DELETE FROM movies";
if (!mysqli_query($link,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
echo "movies table cleared<br>";


$sql = "DELETE FROM genres";
if (!mysqli_query($link,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
echo "genres table cleared<br>";

mysqli_close($con);
?>

</body>
</html>
