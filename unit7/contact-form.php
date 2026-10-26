<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WDV341 Intro to PHP</title>
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

    .container {
      border:1em groove rgb(6, 125, 83);
    }

    header {
      background-color:rgb(6, 125, 83)
    }

    header img {
      max-width:100%;
      width:100%;
      height:auto;
      border-bottom:0.625em groove rgb(6, 125, 83);
      margin-bottom:0;
    }

    h1 {
      font-family: "Story Script", cursive;
      color:rgb(55, 107, 204);
      text-shadow: 0 0 4px white;
      text-align: center;
      font-size: 4em;
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

    .flexbox{
      display:flex;
      gap:100px;
      padding:1em;
      margin:auto;
    }

    .main-col {
      display:flex;
      flex-direction: column;
    }

    .sidebar {
      width:40%;
    }
    .sidebar img {
      width:60%;
      height:auto;
    }

    fieldset {
      background-color:blanchedalmond;
      display:flex;
      flex-direction: column;
      gap:1em;
      padding:2em;
    }

    input {
      margin-left:0.625em;
    }

    legend {
      font-weight:bold;
    }

    select {
      width:35%;
    }

    button {
      width:20%;
      padding:0.625em;
      border-radius: 25px 25px;
      background-color: rgb(6, 125, 83);
      color:white;
    }

    footer {
      text-align: center;
      font-size:0.8em;
      font-style: italic;
    }
  </style>
</head>
<body>
  <div class="container">
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

    <div class="flexbox">
      <div class="sidebar">
        <img src="images/vol-face-camera.jpg" alt="two volunteers face the camera">
        <img src="images/vol-elbows.jpg" alt="two volunteers bump elbows in greeting">
        <img src="images/vol-face-door.jpg" alt="two people with 'volunteer' written on the back of their shirts face a door">
      </div>

      <div class="main-col">
        <h1>Volunteers, Start Here!</h1>
      
        <form action="formHandler.php" method="POST" name="vol-form">
          <fieldset>
            <legend>Volunteer Contact Form</legend>
            <label>First Name:<input type="text" name="fname" id="fname" required></label>
            <label>Surname:<input type="text" name="surname" id="surname" required></label>
            <label>Email:<input type="email" name="email" id="email" required></label>
            <label for="reason"> Reason for contact:</label>
            <select id="reason" name="reason" required>
              <option value="">Select A Reason</option>
              <option value="new">New Volunteer</option>
              <option value="current">Current Volunteer</option>
              <option value="questions">Questions about Volunteering</option>
            </select>
            <label for="message"> Comments:</label>
            <textarea id="message" name="message" placeholder="Message" rows="4" cols="50"></textarea>
            <button type="submit">Submit Form</button>

             <div style="display:none;">
              <label for="website">Website</label>
              <input type="text" id="website" name="website">
            </div>
          </fieldset>
        </form>
      </div>
    </div>

    <footer>
      <p>Copyright 2026 Non-Profit Volunteers United.</p>
    </footer>
  </div>
</body>
</html>