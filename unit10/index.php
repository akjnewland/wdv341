  <?php
  header('Content-Type: application/json');

  $student = [
    "name" => "Austin",
    "degree" => ["Web Dev","Web Design"],
    "id" => $_POST["id"] ?? "";
  ];

  echo json_encode($student);
  ?>