<?php
  require_once("includes/dbConnect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WDV341 DB Connect</title>
</head>
<body>
  <?php
    $sql = "SELECT * FROM wdv341_events";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($stmt->rowCount() == 0){
      echo "<h2>No Events Found</h2>";
    } else { 
      echo "<table><tr><th>Name</th></tr>";
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr><td>" . $row["name"] . "</td></tr>";
      }
      echo "</table>";
    }
    
    $stmt = null;
  ?>
</body>
</html>