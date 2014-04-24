<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>



<?php

$link = mysqli_connect("localhost", "root", "123", "my_db");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
} else {
  echo "Connection successful<br>";
}



$movieid = "";
$title = "";
$director = "";
$genres = array();
$genreskey = 1;
$actors = array();
$actorskey = 1;

$xml=simplexml_load_file("moviedata.xml");
//echo $xml->getName() . "<br>";
foreach($xml->children() as $child) {
  if ($child->getName() == "add") {
    //echo $child->getName() . ": " . $child->attributes();
    //echo "<br>";
    $movieid = $child->attributes();
  }
  if ($child->count() > 0) {
    foreach($child->children() as $child2) {
      //echo $child2->getName() . ": " . $child2->attributes() . ": " . $child2;
      //echo "<br>";
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
          echo "<br>New movie added to movies table: " . $title . "<br>";
          break;
        case "genre":
          settype($child2, "string");
          if (!array_key_exists($child2, $genres)) {
            $genres[$child2] = $genreskey;
            $sql = "INSERT INTO genres VALUES ('$genreskey', '$child2')";
            if (!mysqli_query($link,$sql)) {         
              die('Error: ' . mysqli_error($link));
            }
            echo "New genre added to genres table: " . $child2 . "<br>";
            $genreskey++;
          }
          $insertgenreid = $genres[$child2];
          $sql = "INSERT INTO moviegenres VALUES ('$movieid', '$insertgenreid')";
          if (!mysqli_query($link,$sql)) {         
            die('Error: ' . mysqli_error($link));
          }
          break;
        case "actor":
          echo $child2 . "<br>";
          settype($child2, "string");
          if (!array_key_exists($child2, $actors)) {
            $actors[$child2] = $actorskey;
            $sql = "INSERT INTO actors VALUES ('$actorskey', '$child2')";
            if (!mysqli_query($link,$sql)) {         
              die('Error: ' . mysqli_error($link));
            }
            echo "New actor added to actors table: " . $child2 . "<br>";
            $actorskey++;
          }
          $insertactorid = $actors[$child2];
          $sql = "INSERT INTO movieactors VALUES ('$movieid', '$insertactorid')";
          if (!mysqli_query($link,$sql)) {         
            die('Error: ' . mysqli_error($link));
          }
          break;
        default:
      }
    }
  }
}




mysqli_close($link);
?>

</body>
</html>
