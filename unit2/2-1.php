<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assignment 2-1</title>
</head>
<body>
 
  <?php
    $yourName = "Austin";
    $number1 = 2;
    $number2 = 9;
    $total = $number1 + $number2;
    $wdvLanguages = ['PHP','HTML','JavaScript'];
    

    echo "<h1>Assignment: 2-1 PHP Basics</h1>";
    echo "<h2>$yourName</h2>";
    echo "The result of $number1 + $number2 is: " . $total;
    echo "<br>";
    echo "<ul>";

    forEach ($wdvLanguages as $wdvLanguage) {
      echo "<li>$wdvLanguage</li>";
    }
    echo "</ul>"
  ?>
  
</body>
</html>