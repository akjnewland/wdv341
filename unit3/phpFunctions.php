<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Functions</title>
</head>
<body>
  <!-- Functions & Variables -->
  <?php
    function formatStrings($str) {
      echo "<strong>The number of characters in the string is:</strong> " . strlen($str) . ".<br>"; // displays number of characters in the string
      echo "<strong>Trim the leading and trailing whitespace.</strong> " . trim($str) . "<br>"; // trims leading/trailing whitespace
      echo "<strong>Display the string in all lowercase:</strong> " . strtolower($str) . "<br>"; // displays sring in all lowercase
      
      if(str_contains(strtolower($str), "dmacc")) {
        echo "This string contains the word DMACC.<br>";
      } else {
        echo "This string does not contain the word DMACC.<br>";
      }
    };

    function formatTelNum($num) {
      echo substr($num, 0, 3) . "-" . substr($num, 3, 3) . "-" . substr($num, 6, 4);
    };

    function formatCurrency($curr) {
      echo "$" . number_format($curr, 2);
    };

    function formatDate($unixTimestamp) {
      $localDate = new DateTimeImmutable('@' . $unixTimestamp);
      return $localDate->format("m/d/Y");
    };

    function formatIntlDate($unixStamp) {
      $date = new DateTimeImmutable('@' . $unixStamp);
      return $date->format("d/m/Y");
    };
  ?>

  <!-- Function Executions -->
   <?php
    echo '<h2>Create a function that will accept a Unix Timestamp as a parameter and format it into mm/dd/yyyy format.</h2>';
    echo "Date converted from a unix timestamp: " . formatDate("1790043997");

    echo '<h2> Create a function that will accept a Unix Timestamp as a parameter, format it into mm/dd/yyyy for international dates</h2>';
    echo "An international date formatted from a unix timestamp: " . formatIntlDate("1790043997");

    echo '<h2>What is Des Moines Area Community Colleges acronym?</h2>';
    formatStrings("  It is DMACC.  ");

    echo '<h2>Format 1234567890 in U.S. Standard Phone Number format.</h2>';
    formatTelNum(1234567890);

    echo '<h2>Format a parameter as US Currency with a $ sign.</h2>';
    formatCurrency(1234.56); // could only get the decimal in the right place by adding it here
   ?>
</body>
</html>
