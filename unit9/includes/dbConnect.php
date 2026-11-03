<?php
  $host = "localhost";
  $dbname = "wdv341";
  $username = "root";
  $password = "";

  try { //try to execute some code
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password); // instantiate a connection object
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // designate how errors are to be captured
    $connectionSuccess = true;
  } catch (PDOException $e) { //catch if error occurs
    $connectionSuccess = false;
    error_log($e->getMessage());
  }
?>