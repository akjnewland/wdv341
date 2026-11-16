<?php
header('Content-Type: application/json');

require_once("includes/dbConnect.php");

$sql = "SELECT id, name, description, presenter, event_date, event_time
        FROM wdv341_events
        WHERE id = :eventID";


// 2. Connection Check
if (!$connectionSuccess) {
  http_response_code(500);
  echo json_encode(["status" => "error", "message" => "Unable to connect to database."]);
  exit;
}

try {
  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    ":eventID" => 1
  ]);

  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($row === false){
    error_log("Event not found.");
    http_response_code(404);
    echo json_encode(["status" => "error", "message" => "Event not found."]);
    exit;
  }

  $outputObj = new Event();
  $outputObj->id = $row["id"];
  $outputObj->name = $row["name"];
  $outputObj->description = $row["description"];
  $outputObj->presenter = $row["presenter"];
  $outputObj->event_date = $row["event_date"];
  $outputObj->event_time = $row["event_time"];

  $jsonOutput = json_encode($outputObj, JSON_PRETTY_PRINT);
  echo $jsonOutput;

  } catch(PDOException $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Unable to retrieve event information."]);
    exit;
  }

// 3. Define the Event class
class Event
{
    public $id;
    public $name;
    public $description;
    public $presenter;
    public $event_date;
    public $event_time;
}

