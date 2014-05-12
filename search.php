<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>



<?php
   require_once('Movie.php');

   function getMovieGenres($link, $movie) {
     $movieGenres = array();
     $sqlgenre = "SELECT genre " .
       "FROM moviegenres " .
       "JOIN movies ON moviegenres.movieid = movies.movieid " .
       "JOIN genres ON moviegenres.genreid = genres.genreid " .
       "AND moviegenres.movieid = '" . $movie->getMovieId() . "' " .
       "GROUP BY genre";
     $resultgenre = mysqli_query($link, $sqlgenre);

     while ($rowgenre = mysqli_fetch_array($resultgenre)) {
       array_push($movieGenres, $rowgenre['genre']);
     }
     return $movieGenres;
   }


$search = $_POST['search_term'];

echo "Search Term: " . $search . "<br><br>";

$link = mysqli_connect("localhost", "root", "123", "my_db");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
} else {
  echo "Connection successful<br>";
}

$sql = "SELECT * FROM movies WHERE title LIKE '%$search%'";
$result = mysqli_query($link, $sql);
?>
<table border = '1'>
  <tr>
    <th>movieid</th>
    <th>title</th>
    <th>director</th>
    <th>genres</th>
    <th>actors</th>
  </tr>

<?php
$rowCount = 0;
while ($row = mysqli_fetch_array($result)) {
  if ($rowCount % 2) {
    $oddClass = "class=\"odd\"";
  } else {
    $oddClass = "";
  }

  $rowCount += 1;

  $movie = new Movie($row['movieid'], $row['title'], $row['director']);
  $genres = getMovieGenres($link, $movie);
?>
  <tr <?= $oddClass ?>>
    <td><?= $movie->getMovieId() ?></td>
     <td><?= $movie->getTitle() ?></td>
     <td><?= $movie->getDirector() ?></td>
    <td><?= join(", ", $genres); ?></td>

<?php
  $sqlactor = "SELECT actor FROM movieactors JOIN movies ON movieactors.movieid = movies.movieid JOIN actors ON movieactors.actorid = actors.actorid AND movieactors.movieid = '" . $movie->getMovieId() . "' GROUP BY actor";
  $resultactor = mysqli_query($link, $sqlactor);
  echo "<td>";
  $rowzero = mysqli_fetch_array($resultactor);
  echo $rowzero['actor'];
  while ($rowactor = mysqli_fetch_array($resultactor)) {
    echo"; " . $rowactor['actor'];
  }
  echo "</td>";
  echo "</tr>";
}
echo "</table>";
echo "<br>";


?>


</body>
</html>