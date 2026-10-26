<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Volunteer Form Handler</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Story+Script&display=swap');

.story-script {
  font-family: "Story Script", sans-serif;
  font-weight: 400;
  font-style: normal;
}

body {
  background-color: rgb(246, 241, 222);
  margin:0;
}

header {
  background-color:rgb(6, 125, 83);
  width:100%;
}

header img {
  max-width:100%;
  width:100%;
  height:auto;
  border-bottom:0.625em groove rgb(6, 125, 83);
  margin-bottom:0;
}

h3 {
  font-family: "Story Script", cursive;
  color:rgb(55, 107, 204);
  text-shadow: 0 0 4px white;
  text-align: center;
  font-size:1.4em;
}

nav {
  border-bottom:0.625em groove rgb(6, 125, 83);
  background-color:rgb(6, 125, 83);
  color:white;
  margin-top:0;
}

nav ul {
  display:flex;
  justify-content: flex-end;
  gap:1em;
  padding:1em;
  margin:0;
}

nav ul li {
  list-style-type: none;
  font-size:2em;
}

nav ul li:hover {
  text-decoration: underline;
  color:black;
}

.confirmation {
  text-align:center;
  margin:auto;
  padding:0;
  border:1px solid grey;
  width:50%;
}

#returnBtn {
  padding:1em;
  border-radius: 25px 25px;
  background-color: rgb(6, 125, 83);
  color:white;
  text-decoration:none;
  font-weight:bold;
  margin:1em;
}

footer {
  text-align: center;
  font-size:0.8em;
  font-style: italic;
}
</style>
</head>

<body>
  <header>
    <img src="images/vols-needed.jpg" alt="white hands hold a carboard sign that reads: volunteers needed">
    <nav>
      <ul>
        <li>Homepage</li>
        <li>The Volunteer Experience</li>
        <li>Volunteer Projects</li>
        <li>About Us</li>
        <li>Contact Form</li>
      </ul>
    </nav>
  </header>

<?php 
//PHP Mailer use statements
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Honeypot check
if (!empty($_POST["website"])) {
    exit("Spam submission detected.");
}

// Variables bank
$first_name = trim($_POST["fname"] ?? "");
$last_name = trim($_POST["surname"] ?? "");
$email = trim($_POST["email"] ?? "");
$message = trim($_POST["message"] ?? "");
$message_content = ($message != '') ? $message : "No message submitted.";
$html_message = "";
$reason = $_POST["reason"] ?? "";
$permitted_reasons = [
'new' => 'New Volunteer',
'current' => 'Current Volunteer',
'questions' => 'Questions about Volunteering'];
$dateReceived = new DateTime('now', new DateTimeZone('UTC'));
$localTime = clone $dateReceived;
$localTime->setTimezone(new DateTimeZone('America/Chicago'));
$timeStamp = $localTime->format('m/d/Y \a\t g:i A');
$errors = [];


if($_SERVER['REQUEST_METHOD'] === 'POST'){
  // Validations
  if($first_name === ""){
    $errors[] = "Please enter your first name.";
  };

  if($last_name === ""){
    $errors[] = "Please enter your surname.";
  };

  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors[] = "Please enter a valid email address.";
  };

  if(!array_key_exists($reason, $permitted_reasons)){
    $errors[] = "Please select a reason.";
  };

  // Errors
  if(count($errors) > 0){
  echo "<h3>Registration Error</h3>";
  echo "<ul>";
    foreach($errors as $error){
      echo "<li>" . ($error) . "</li>";
    };
  echo "</ul>";
  echo '<a href="contact-form.php" id="returnBtn">Return to Volunteer Form</a>';
  } else {
    echo '<h3>Volunteer Form</h3>';
    echo '<div class="confirmation">';
    echo '<p>' . htmlspecialchars($first_name) . " " . htmlspecialchars($last_name) . 
    ',<br> Thank you for submitting a volunteer interest form!</p>' .
    '<p> Your message was received as of ' . $timeStamp . '.</p>' .
    '<p> We have your reason for contact listed as: ' . $permitted_reasons[$reason] . '.</p>' .
    '<p> If any of this information looks incorrect, please reach out to us.</p>' .
    '<p> Looking forward to volunteering together!</p>' .
    '<p><br>- The Volunteers Unite Team</p>';
  
  if($message !== '') {
    echo '<p>We have received your message: <br>"' . htmlspecialchars($message) . '"<br> on ' . $timeStamp . '</p>';
  }
  
  echo '<p>We will reply to this email: ' . htmlspecialchars($email) . '</p>';
  echo '<p>Have a great day!</p>';
  echo '</div>';
  echo '<a href="contact-form.php" id="returnBtn">Return to Volunteer Form</a>';

  require 'PHPMailer/src/Exception.php';
  require 'PHPMailer/src/PHPMailer.php';
  require 'PHPMailer/src/SMTP.php';

  $mail = new PHPMailer(true); // REMOVE PASSWORD BEFORE UPLOADING TO GITHUB

  // Email Content
  $volunite_subject = 'New Volunteer Form Submission';
  
  $volunite_html_body = 
  '<h1>New Volunteer Form Submission</h1>' .
  '<p>The following information has been submitted as of ' . 
  $timeStamp . ':</p><br>' .
  '<ul>' . 
  '<li>Name: ' . 
  htmlspecialchars($first_name) . " " . 
  htmlspecialchars($last_name) . '</li>' . 
  '<li>Email: ' . htmlspecialchars($email) . '</li>' . 
  '<li>Reason: ' . $permitted_reasons[$reason] . '</li>' .
  '<li>Message: ' . htmlspecialchars($message_content) . '</li>' .
  '</ul>';
  
  $volunite_plain_body = 'New Volunteer Form Submission!' . 
  ' The following information has been submitted as of ' . 
  $timeStamp . ':' . "\n" .
  'Name: ' . $first_name . ' ' . 
  $last_name . "\n" . 
  'Email: ' . $email . "\n" . 
  'Reason: ' . $permitted_reasons[$reason] . "\n" .
  'Message: ' . $message_content . "\n";

  if($message !== ''){
    $html_message = '<p>Your message includes the following comment: ' . htmlspecialchars($message) . '</p>';
  }

  $contact_subject = $permitted_reasons[$reason] . ' with Volunteers Unite!';
  
  $contact_html_body = 
  '<div style="background-color:#ffebcd; border:1em groove rgb(6, 125, 83);">' .
  '<div><img src="cid:volunteers-image" alt="white hands hold a carboard sign that reads: volunteers needed" style="max-width:100%; width:100%; height:auto; border-bottom:0.625em groove rgb(6, 125, 83); margin:0;"></div>' .
  '<h1 style="color:rgb(55, 107, 204); text-align:center;">Volunteer Form Submission</h1>' .
  '<div style="width:50%; margin:auto; border:2px solid grey; padding:1em; font-size:1.2em;">' .
  '<p>' . htmlspecialchars($first_name) . ' ' . htmlspecialchars($last_name) .
  ',<br><br> Thank you for reaching out to <strong>Volunteers Unite.</strong></p>' .
  '<p> Your message was received as of ' . $timeStamp . '.</p>' .
  '<p> We have your reason for contact listed as: ' . $permitted_reasons[$reason] . '.</p>' .
  '<p> If any of this information looks incorrect, please reach out to us.</p>' .
  $html_message .
  '<p> We will respond within <strong>3-5 business days</strong>.</p>' . 
  '<p> Looking forward to volunteering together!</p>' .
  '<p style="font-style:italic"><br>- The Volunteers Unite Team</p>' .
  '</div>' .
  '<div style="font-style:italic; font-size:0.8em; text-align:center; margin-top:2em;">Copyright 2026 Non-Profit Volunteers United.</div>' .
  '</div>';
  
  $contact_plain_body = htmlspecialchars($first_name) . ' ' . htmlspecialchars($last_name) .
  ', thank you for reaching out to Volunteers Unite.
  Your message was received as of ' . $timeStamp . '. ' .
  'We have your reason for contact listed as: ' . $permitted_reasons[$reason] . '. ' .
  'If any of this information looks incorrect, please reach out to us.' .
  'We will respond within 3-5 business days.
  Looking forward to volunteering together!
  - The Volunteers Unite Team';


  try {
    $mail->SMTPDebug = 0; // set to 2 for verbose debug print to page.
    $mail->isSMTP(); // Use SMTP to send.
    $mail->Host = 'smtp.gmail.com'; // Specify Gmail's SMTP server.
    $mail->SMTPAuth = true; // Enable SMTP authentication.
    $mail->Username = 'newland.austink@gmail.com'; // Your full Gmail address.
    $mail->Password = ''; // Your 16-character App Password.
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption.
    $mail->Port = 587; // TCP port for TLS.

    // Recipients
    $mail->setFrom('newland.austink@gmail.com', 'Austin N'); // Sender's email and name.
    $mail->addAddress('anewland@dmacc.edu', 'Austin N'); // Recipient's email and name.
    // Optional: Add a CC or BCC recipient
    // $mail->addCC('cc_recipient@example.com');
    // $mail->addBCC('bcc_recipient@example.com');

    // Content
    $mail->isHTML(true); // Set email format to HTML.
    $mail->Subject = $volunite_subject; // Email subject.
    $mail->Body = $volunite_html_body; // HTML body.
    $mail->AltBody = $volunite_plain_body; // Plain text for non-HTML clients.
    // Optional: Add an attachment
    // $mail->addAttachment('/path/to/your/file.pdf', 'filename.pdf');.

    $mail->send();

    $mail->clearAddresses();

    $mail-> addEmbeddedImage(__DIR__ . '/images/vols-needed.jpg','volunteers-image');
    
    $mail->isHTML(true); // Set email format to HTML.
    $mail->addAddress($email);
    $mail->Subject = $contact_subject; // Email subject.
    $mail->Body = $contact_html_body; // HTML body.
    $mail->AltBody = $contact_plain_body; // Plain text for non-HTML clients.
    
    $mail->send();
  
    } catch (Exception $e) {
      echo '<h3>Message could not be sent. Mailer Error: ' . $mail->ErrorInfo . '</h3>';
    }
  }
};
?>

  <footer>
    <p>Copyright 2026 Non-Profit Volunteers United.</p>
  </footer>
</body>
</html>