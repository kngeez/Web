<!DOCTYPE html>
<html>
<body>

<h1></h1>


<?php

$link = mysqli_connect("localhost", "root", "123", "my_db");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
} else {
  echo "Connection successful<br>";
}


// adds a movie to movies table
/*
$a = "tt0484562";
$b = "The Seeker: The Dark Is Rising";
$c = "Cunningham, David L.";
$sql = "INSERT INTO movies VALUES ('$a', '$b', '$c')";

if (!mysqli_query($link,$sql)) {
  die('Error: ' . mysqli_error($link));
}
echo "1 record added<br>";
*/




$movieid = "";
$title = "";
$director = "";

$xml=simplexml_load_file("moviedata.xml");
//echo $xml->getName() . "<br>";
foreach($xml->children() as $child) {
  if ($child->getName() == "add") {
    echo $child->getName() . ": " . $child->attributes();
    echo "<br>";
    $movieid = $child->attributes();
  }
  if ($child->count() > 0) {
    foreach($child->children() as $child2) {
      echo $child2->getName() . ": " . $child2->attributes() . ": " . $child2;
      echo "<br>";
      switch($child2->attributes()) {
        case "title":
          $title = $child2;
          break;
        case "director":
          $director = $child2;
          $sql = "INSERT INTO movies VALUES ('$movieid', '$title', '$director')";
          if (!mysqli_query($link,$sql)) {         
            die('Error: ' . mysqli_error($link));
          }
          echo "1 record added<br>";
      }
    }
  }
}




mysqli_close($link);
?>

</body>
</html>
