<?php
date_default_timezone_set("Asia/Calcutta"); 
$servername = "localhost";
$username = "wahm_admin";
$password = "hacktheplanet";
$dbname = "wahm_eal";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}