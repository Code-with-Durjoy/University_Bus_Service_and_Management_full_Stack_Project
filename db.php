<?php
$mysqli = new mysqli("localhost", "root", "", "bus_service");
if ($mysqli->connect_errno) {
  http_response_code(500);
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  exit();
}
?>