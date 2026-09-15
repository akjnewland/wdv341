<?php
  function greetUser($name) {
    echo "Welcome, $name!";
  }

  function addNUmbers($num1, $num2) {
    
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Functions Demo</title>
</head>
<body>
  <h1>PHP Functions Practice</h1>
  
  <?php
    greetUser("Austin") . "<br>";
    echo "<br>";
    $x = 3;
    $y = 5;
    $total = addNumbers($x, $y);
    echo "The result of $x + $y is: " . $total;
  ?>
</body>
</html>