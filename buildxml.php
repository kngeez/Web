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


$sql = "INSERT INTO movies VALUES ('tt0484562', 'The Seeker: The Dark Is Rising', 'Cunningham, David L.')";

if (!mysqli_query($link,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
echo "1 record added";


mysqli_close($con);
?>

</body>
</html>
