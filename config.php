<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "acv";
$base_url = "localhost/";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


?>
