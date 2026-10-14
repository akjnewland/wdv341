<?php
  $message = "";
  $showImage = "";
  $name = $_POST['petName'] ?? "";
  $species = $_POST['petType'] ?? "";
  $age = $_POST['petAge'] ?? "";
  $habitat = $_POST['petHome'] ?? [];
  $allClear = false;
  $imageExtensions = ["jpg","jpeg","png","gif"];
  $altText = $_POST['imageDescription'] ?? "Image uploaded by user.";



  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fileError = $_FILES["imageFile"]["error"] ?? UPLOAD_ERR_NO_FILE;
    
    // honeypot
    if (!empty($_POST["website"])) {
      exit("Form submission failed.");
    }

    if ($_FILES["imageFile"]["error"] == 0) {
      $fileName = $_FILES["imageFile"]["name"];
      $temporaryFile = $_FILES["imageFile"]["tmp_name"];
      $fileSize = $_FILES["imageFile"]["size"];

      $fileExtension = strtolower(
      pathinfo($fileName, PATHINFO_EXTENSION)
      );

      if ($fileSize <= 2000000) {  //2MB
            
      if (in_array($fileExtension, $imageExtensions)) {
        $newName = uniqid() . "." . $fileExtension;
        $destination = "uploads/" . $newName;

        if (move_uploaded_file($temporaryFile, $destination)) {
          $message = "File uploaded successfully.";
          $allClear = true;
          $showImage = '<img src ="' . htmlspecialchars($destination) . '"' . ' alt="' . htmlspecialchars($altText) . '">';
        } else {
          $message = "Unable to save file.";
        }
  
      } else {
        $message = "Only image files are allowed.";
      }
          } else {
            $message = "File exceeds size limit.";
          }
    } else {
        if($fileError === UPLOAD_ERR_NO_FILE){
          $message = "Please choose a file.";
        } else if($fileError === UPLOAD_ERR_INI_SIZE || $fileError === UPLOAD_ERR_FORM_SIZE){
          $message = "That file size is too large.";
        } else {
          $message = "Upload failed. Please try again.";
        }
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pet Profile Builder</title>
  <style>
    body {
      background-color:#588157;
    }

    .imageContainer {
      padding:2em;
      margin:0 auto;
      font-weight:bold;
      text-align:center;
      width:40%;
    }

    input[type=file] {
      padding:1em;
    }

    img {
      width:25%;
      height:auto;
      padding:2em;
    }

    fieldset {
      font-family:cambria;
      font-weight:bold;
      font-size:1.3em;
      padding:1em;
      margin:1em;
      gap:1em;
    }

    h1 {
      text-align:center;
      text-shadow:0px 0px 4px white;
      font-size:3.4em;
    }

    hr {
      width:80%;
      border:2px solid black;
      margin-bottom:2em;
    }

    .form{
      display:flex;
      margin:auto;
    }

    .formFields {
      width:40%;
    }

    #submitBtn {
      background-color:black;
      color:white;
      font-weight:bold;
      padding:1em;
      border-radius:12px 12px;
      margin:1em;
    }

    #resetBtn {
      background-color:black;
      color:white;
      font-weight:bold;
      padding:0.625em;
      border-radius:12px 12px;
      margin:1em;
      text-decoration:none;
      border:2px inset grey;
      font-family:sans-serif;
      font-size:0.8em;
    }

    .buttons {
      margin:0 2em;
    }

    /* Trying something new here */
    .trapper {
    position: absolute;
    left: -9999px;
    }
  </style>
</head>
<body>
  <h1>Build A Pet Profile</h1>
  <hr>

  <div class="container">
    <form action="index.php" method="post" enctype="multipart/form-data" class="form">
      <div class="formFields">

        <!-- Text Field -->
        <fieldset>
          <legend>Pet Name</legend>
          <label for="petName">
            <input type="text" id="petName" name="petName">
          </label>
        </fieldset>

        <!-- Radios -->
        <fieldset>
          <legend>Type of Pet</legend>
          <label for="petType"><input type="radio" name="petType" id="dog" value="dog">Dog</label>
          <label for="petType"><input type="radio" name="petType" id="cat" value="cat">Cat</label>
          <label for="petType"><input type="radio" name="petType" id="bird" value="bird">Bird</label>
          <label for="petType"><input type="radio" name="petType" id="Livestock" value="livestock">Livestock</label>
          <label for="petType"><input type="radio" name="petType" id="exotic" value="exotic pet">Exotic Pet</label>
        </fieldset>

        <!-- Dropdown -->
        <fieldset>
          <legend>Pet Age</legend>
          <input type="number" name="petAge" min="0" max="30">
        </fieldset>

        <!-- Checkboxes -->
        <fieldset>
          <legend>Indoor / Outdoor Pet</legend>
          <label>
            <input type="checkbox" name="petHome[]" id="indoor" value="indoors">Indoor
          </label>
          
          <label>
            <input type="checkbox" name="petHome[]" id="outdoor" value="outdoors">Outdoor
          </label>
        </fieldset>

        <!-- Honeypot -->
         <div class="trapper" aria-hidden="true">
          <label for="website">Leave this field empty
            <input type="text" name="website" id="website" autocomplete="off" tabindex="-1">
          </label>
        </div>

        
      </div>

      <!-- Image box -->
      <fieldset class="imageContainer">
        <legend>Pet Image</legend>
        <label for="imageFile">Choose an Image:</label>
        <input type="file" id="imageFile" name="imageFile"><br>
        <input type="text" id="imageDescription" name="imageDescription">

        <br>

        <div class="buttons">
          <input type="submit" id="submitBtn" value="Upload Image">
        </div>
        
        <!-- PHP messages -->
        <?php
          if($message != ""){
            echo "<p>" . htmlspecialchars($message) . "</p>";
          }
        ?>

      </fieldset> <!-- Image container close -->
    </form> <!-- end of form -->
  </div> <!-- end of container -->

  <?php
    if($allClear) {
      echo "<h2>" . htmlspecialchars($name) . "'s Profile!</h2><br>";
      echo "<p>Your " . htmlspecialchars($species) . " is " . htmlspecialchars($age) . " age. They live " . htmlspecialchars(implode(', ', $habitat)) . "!</p>";
      echo $showImage;
    }
  ?>

</body>
</html>