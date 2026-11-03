<?php
  require_once("includes/dbConnect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WDV341 DB Connect</title>
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
      margin-bottom:2em;
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
      font-size:1.7em;
      font-weight:bold;
      padding-bottom:1em;
    }

    td {
      border: 0.11em solid #001F3F;
      font-family:Cambria, sans-serif;
      padding:3em;
      margin:1em;
      text-align:center;
      font-weight:bold;
      background-color:#d3c7a2;
    }
  </style>
</head>
<body>
  <header>
    <h1>Events</h1>
  </header>
  <?php
    $sql = "SELECT * FROM wdv341_events";

    if($connectionSuccess) {
      try {
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);      

        if(count($rows)== 0){
          echo '<div class="alerts"><h2>No Events Found</h2></div>';
        } else { 
          $columnNames = [
            "name" => "Name",
            "description" => "Event Description",
            "presenter" => "Event Host",
            "event_date" => "Date",
            "event_time" => "Time"
          ];

          echo '<table>';
          echo '<tr>';
          foreach($columnNames as $cols => $label) {
            echo "<th>" . htmlspecialchars($label) . "</th>";
          }
          
          echo "</tr>";
          foreach($rows as $row) {
            echo "<tr>";
            foreach($columnNames as $cols => $label) {
              echo "<td>" . htmlspecialchars($row[$cols]) . "</td>";
            }
            echo "</tr>";
          }
          echo "</table>";
        }
      } catch (PDOException $e) {
        error_log($e->getMessage());
        echo '<div class"alerts"><h2>Events are unavailable at this time.</h2></div>';
        echo '<div class"alerts"><p>If you think this is incorrect, please contact the webmaster or try again later.</p></div>';
      }
    } else {
      echo '<div class"alerts"><h2>Database connection failed.</h2></div>';
    }

    
    
    $stmt = null; // Good habit to clear out your $stmt
  ?>
</body>
</html>