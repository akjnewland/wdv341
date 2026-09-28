<?php
require_once("classes/Student.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assignment: 4-1 Creating a Student Class</title>
</head>
<body>
  <?php
    $student1 = new Student(
    "Austin",
    "Newland",
    "anewland@dmacc.edu",
    "Web Development, Full Stack, AAS"
    );

    echo $student1->displayStudent();

    $student2 = new Student (
      "Doe",
      "Johnson",
      "djohnson@dmacc.edu",
      "Funeral Services"
    );

    echo $student2->displayStudent();

    $student3 = new Student (
      "Ken",
      "Barbenheimer",
      "kbarbenheimer@dmacc.edu",
      "Fashion and Cybersecurity"
    );

   echo $student3->displayStudent();
  ?>
  
</body>
</html>