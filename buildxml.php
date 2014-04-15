<!DOCTYPE html>
<html>
<body>

<h1>Test<br></h1>


<?php

$link=mysqli_connect("localhost", "root", "123", "my_db");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
else
  {
  echo "Connection successful";
  }

/*
$sql = "INSERT INTO Persons (FirstName, LastName, Age)
VALUES
('$_POST[firstname]', '$_POST[lastname]', '$_POST[age]')";

if (!mysqli_query($link,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
echo "1 record added";
*/

mysqli_close($con);
?>

</body>
</html>
