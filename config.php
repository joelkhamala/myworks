<?php
session_start();
$servername = "sql210.epizy.com";
$username = "epiz_28285137";
$password = "F0rgeCpNBoo0PI";
$dbname = "epiz_28285137_vpmsdb";

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>