<?php
require_once("classes/Movie.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Movie Demo</title>
</head>
<body>
  <?php
    $movie = new Movie("The Matrix", "Lana Wachowski", "Sci-Fi", 2002);
    echo $movie->getTitle(); 

    echo $movie->setTitle("The Matrix Revolutions");

    echo "<br>";
    echo $movie->getTitle();

    $movie2 = new Movie("The Big Lebowski", "Director", "Comedy", 2000);

    $movie2->getTitle();
  ?>
</body>
</html>