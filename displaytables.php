<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>

<h1></h1>


<?php
$link=mysqli_connect("localhost","root","123","my_db");
// Check connection
if (!$link) {
  echo mysqli_connect_errno();
  exit;
}
else {
  echo "Connection successful<br>";
}
mysqli_set_charset($link, "utf8");
echo "<br>";

$result = mysqli_query($link, "SELECT * FROM movies");

echo "<table border = '1'>
<tr>
<th>movieid</th>
<th>title</th>
<th>director</th>
</tr>";

while ($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['movieid'] . "</td>";
  echo "<td>" . $row['title'] . "</td>";
  echo "<td>" . $row['director'] . "</td>";
}
echo "</table>";
echo "<br>";

$result = mysqli_query($link, "SELECT * FROM genres");

echo "<table border = '1'>
<tr>
<th>genreid</th>
<th>genre</th>
</tr>";

while ($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['genreid'] . "</td>";
  echo "<td>" . $row['genre'] . "</td>";
}
echo "</table>";
echo "<br>";

$result = mysqli_query($link, "SELECT * FROM moviegenres");

echo "<table border = '1'>
<tr>
<th>movieid</th>
<th>genreid</th>
</tr>";

while ($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['movieid'] . "</td>";
  echo "<td>" . $row['genreid'] . "</td>";
}
echo "</table>";
echo "<br>";

$result = mysqli_query($link, "SELECT * FROM actors");

echo "<table border = '1'>
<tr>
<th>actorid</th>
<th>actor</th>
</tr>";

while ($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['actorid'] . "</td>";
  echo "<td>" . $row['actor'] . "</td>";
}
echo "</table>";
echo "<br>";

$result = mysqli_query($link, "SELECT * FROM movieactors");

echo "<table border = '1'>
<tr>
<th>movieid</th>
<th>actorid</th>
</tr>";

while ($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['movieid'] . "</td>";
  echo "<td>" . $row['actorid'] . "</td>";
}
echo "</table>";
echo "<br>";


mysqli_close($link);
?>