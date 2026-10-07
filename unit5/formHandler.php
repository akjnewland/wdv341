<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WDV341 Basic Form Handler</title>
<link rel="stylesheet" href="styles.css" type="text/css">
</head>

<body>
<?php
// honeypot
if (!empty($_POST["website"])) {
    exit("Spam submission detected.");
}

$first_name = trim($_POST["first_name"] ?? "");
$last_name = trim($_POST["last_name"] ?? "");
$school_name = trim($_POST["school_name"] ?? "");
$email = trim($_POST["email"] ?? "");
$academic_range = trim($_POST["academic_range"] ?? "");
$major = trim($_POST["major"] ?? "");
$contact = $_POST["contact"] ?? [];
$comments = trim($_POST["comments"] ?? "");
$progInfo = in_array('progInfo', $contact, true);
$progAdvisor = in_array('progAdvisor', $contact, true);
$errors = [];

if($first_name === ""){
  $errors[] = "Please enter your <u><strong>first name.</strong></u>";
};

if($last_name === ""){
  $errors[] = "Please enter your <u><strong>surname.</strong></u>";
};

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
  $errors[] = "Please enter a <u><strong>valid email address</strong></u>.";
};

if($major === ""){
  $errors[] = "Please indicate which <u><strong>major</strong></u> you are interested in.";
};

if(count($errors) > 0){
  echo "<h1>Registration Error</h1><br><hr>";
  echo "<ul>";
    foreach($errors as $error){
      echo "<li>" . ($error) . "</li>";
    };
  echo "</ul>";
  echo '<a href="input-form.html" id="returnBtn">Return to DMACC Interest Form</a>';
} else {
    echo '<h1>DMACC IT &amp; Design Interest Form</h1><br><hr>';
    echo '<div class="confirmation">';
    echo '<p>Dear ' . htmlspecialchars($first_name) . ', </p>';
    echo '<p>Thank you for your interest in DMACC.</p>';
    
    if($academic_range != ""){
      echo '<p>We have you listed as a ' . htmlspecialchars($academic_range) . ' starting this Fall.</p>';
    } else {
      echo '<p>We will confirm your academic standing when we contact you.</p>';
    };
    
    echo '<p>You have declared ' . htmlspecialchars($major) . ' as your major.</p>';

    if($progInfo && $progAdvisor){
      echo '<p>Based upon your response, we will provide additional program information and have an advisor contact you at the following email: ' . htmlspecialchars($email) . '.</p>';
    } elseif($progInfo) {
      echo '<p>Based upon your response, we will provide additional program information to the following email: ' . htmlspecialchars($email) . '.</p>';
    } elseif($progAdvisor) {
      echo '<p>Based upon your response, we will have an advisor contact you at the following email: ' . htmlspecialchars($email) . '.</p>';
    } else {
      echo "You have chosen not to receive additional program information or have an advisor contact you. If this is incorrect, please reach out to let us know.";
    };

    if($comments != ""){
      echo '<p>We will review the following comment:<br> ' . htmlspecialchars($comments) . '</p>';
    } else {
      echo "";
    };

    echo '</div>';
    echo '<a href="input-form.html" id="returnBtn">Return to DMACC Interest Form</a>';
  };

?>

</body>
</html>