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
$sql = "INSERT INTO movies VALUES ('tt0484562', 'The Seeker: The Dark Is Rising', 'Cunningham, David L.')";

if (!mysqli_query($link,$sql)) {
  die('Error: ' . mysqli_error($con));
}
echo "1 record added";
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
          $sql = "INSERT INTO movies VALUES ($movieid, $title, $director)";
          if (!mysqli_query($link,$sql)) {
            echo "something wrong<br>";            
            die('Error: ' . mysqli_error($con));
          }
          echo "1 record added";
      }
    }
  }
}




mysqli_close($con);
?>

</body>
</html>
