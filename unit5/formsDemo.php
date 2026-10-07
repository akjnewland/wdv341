<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Workshop Registration</title>
</head>

<body>
  <h1>Web Development Workshop Registration</h1>

  <p>
    Complete the form to register for an upcoming web development workshop.
  </p>

  <form action="workshop-handler.php" method="post">

    <p>
      <label for="full_name">Full Name:</label>
      <input type="text" name="full_name" id="full_name">
    </p>

    <p>
      <label for="email">Email Address:</label>
      <input type="email" name="email" id="email">
    </p>

    <p>
      <label for="session">Choose a session:</label>
      <select name="session" id="session">
        <option value="">Select a session</option>
        <option value="HTML and CSS">HTML and CSS</option>
        <option value="JavaScript Basics">JavaScript Basics</option>
        <option value="PHP Fundamentals">PHP Fundamentals</option>
      </select>
    </p>

    <fieldset>
      <legend>Attendance preference:</legend>

      <label>
        <input type="radio" name="attendance" value="in-person">
        In person
      </label>

      <label>
        <input type="radio" name="attendance" value="online">
        Online
      </label>
    </fieldset>

    <fieldset>
      <legend>Topics of interest:</legend>

      <label>
        <input type="checkbox" name="topics[]" value="Forms">
        Forms
      </label>

      <label>
        <input type="checkbox" name="topics[]" value="Databases">
        Databases
      </label>

      <label>
        <input type="checkbox" name="topics[]" value="Security">
        Security
      </label>
    </fieldset>

    <p>
      <label for="comments">Additional Comments:</label>
      <br>
      <textarea name="comments" id="comments" rows="5" cols="40"></textarea>
    </p>

    <!-- Honeypot field: normal users should leave this empty -->
    <div style="display: none;">
      <label for="website">Website:</label>
      <input type="text" name="website" id="website">
    </div>

    <p>
      <input type="submit" value="Register">
      <input type="reset" value="Reset">
    </p>

  </form>
</body>
</html>