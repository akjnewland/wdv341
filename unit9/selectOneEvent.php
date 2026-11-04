<?php
  require_once("includes/dbConnect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Events</title>
  <style>
    * {
      box-sizing:border-box;
      font-family:Verdana, sans-serif;
    }

    body {
      background-color:#E0C9A6;
    }

    h1 {
      font-size:3em;
      text-align:start;
      border-bottom:0.1em groove #001F3F;
      color: #3D9970; 
    }

    .alerts {
      background-color: #3D9970;
      color: #001F3F;
      text-align:center;
      margin:auto;
      width:40%;
      border:0.2em groove #001F3F;
    }

    table {
      padding:1em;
    }

    th {
      color: #001F3F;
      text-align:center;
      font-size:1.2em;
      font-weight:bold;
      padding-bottom:0.625em;
    }

    td {
      border: 0.11em solid #001F3F;
      font-family:Cambria, sans-serif;
      padding:1em;
      text-align:center;
      font-weight:bold;
      background-color: #ffebcd;
    }
  </style>
</head>
<body>
  <header>
    <h1>Events</h1>
  </header>
  <?php
    $sql = "SELECT * FROM wdv341_events WHERE id = :eventID";
    $eventID = 3;
    $recordAvailable = false;

    if($connectionSuccess) {
      try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
          ":eventID" => $eventID
        ]);

        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $recordAvailable = true;
            echo "<table>";
            echo "<tr><th>Event name:</th>" . "<td>" . htmlspecialchars($row["name"]) . "</td></tr>";
            echo "<tr><th>Event Description:</th>" . "<td>" . htmlspecialchars($row["description"]) . "</td></tr>";
            echo "<tr><th>Event Presenter:</th>" . "<td>" . htmlspecialchars($row["presenter"]) . "</td></tr>";
            echo "<tr><th>Event Date:</th>" . "<td>" . htmlspecialchars($row["event_date"]) . "</td></tr>";
            echo "<tr><th>Event Time:</th>" . "<td>" . htmlspecialchars($row["event_time"]). "</td></tr>";
            echo "</table>";
          } 
        

        if(!$recordAvailable){
          echo '<div class="alerts"><h2>No Events Found</h2></div>';
        } 
        
      } catch (PDOException $e) {
        error_log($e->getMessage());
        echo '<div class="alerts"><h2>Events are unavailable at this time.</h2></div>';
        echo '<div class="alerts"><p>If you think this is incorrect, please contact the webmaster or try again later.</p></div>';
      }
    } else {
      echo "<h2>Connection to database could not be established.</h2>";
    }
   
    
    $stmt = null; // Good habit to clear out your $stmt
  ?>
</body>
</html>